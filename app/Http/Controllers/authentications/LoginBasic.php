<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LoginBasic extends Controller
{

  public function index()
  {
    if (Auth::check()) {
      return redirect('/dashboard');
    }

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }


  public function loginMasuk(Request $request)
  {

    $request->validate([
      'username' => 'required|string|max:255',
      'password' => 'required|string|min:6',
    ]);

    $credentials = $request->only('username', 'password');
    // return $credentials;

    if (Auth::attempt($credentials)) {

      $user = Auth::user();
      // return $user;
      if ($user->status != 1) {
        Auth::logout();

        throw ValidationException::withMessages(['status' => 'Akun anda tidak aktif. Harap hubungi administrator.']);
      }

      // Jika login berhasil, redirect ke halaman yang diinginkan
      return redirect()->intended('/dashboard');
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return redirect()->back()->withErrors(['username' => 'Username atau password salah']);
  }


  public function loginMasukSSO(Request $request)
  {
    // Ambil parameter dari URL
    $clientId = $request->input('client_id');
    $userEmail = $request->input('user_email');
    $userKey = $request->input('user_key');
    if (!$clientId || !$userEmail || !$userKey) {
      return redirect('/login')->with('error', 'Invalid login link.');
    }

    $accessToken = $this->getAccessToken($clientId, $userEmail, $userKey);
    // return $accessToken;
    if ($accessToken['status'] == false) {
      return redirect('/login')->with('error',  $accessToken['message']);
    }

    $authcallback = $this->getauthCallBack($clientId, $accessToken['data']['access_token']);

    if ($authcallback['status'] == false) {
      return redirect('/login')->with('error',  $accessToken['message']);
    }
    $username = $authcallback['data']['username_app']['username'];

    $name = $authcallback['data']['user_sso']['name'];
    $email = $authcallback['data']['user_sso']['email'];
    $jenis_kelamin = $authcallback['data']['user_sso']['jenis_kelamin'];
    $avatarUrl = $authcallback['data']['user_sso']['avatar'];

    $cek_username = User::where('username', $email)->first();


    if (!$username || $username && !$cek_username) {
      //cek username
      if ($cek_username) {
        return redirect('/login')->with('error',  'email telah terdaftar dan digunakan');
      }

      $photoPath = $this->downloadAvatar($avatarUrl);

      $user = new User();
      $user->name = $name;
      $user->email = $email;
      $user->username = $email;
      $user->password = 'sso_helpdesk';
      $user->jenis_kelamin = $jenis_kelamin;
      $user->sso = '1';
      $user->status = '1';
      $user->profile_photo_path = $photoPath;


      if ($user->save()) {
        //pemberian role
        $nama_role = Role::where('name', 'User')->first();
        $user->assignRole($nama_role);


        $savetoSSo = $this->saveNewUsernameSSo($clientId, $accessToken['data']['access_token'], $user->email);
        if ($savetoSSo['status'] == false) {
          return redirect('/login')->with('error',  'Ada kendala pada saat simpan ke SSO');
        }
      }
    }
    // Login otomatis
    $request->merge([
      'username' => $email,
      'password' => 'sso_helpdesk', // Password default
    ]);

    return $this->loginMasuk($request);
  }
  private function getAccessToken($clientId, $userEmail, $userKey)
  {
    $client = new Client([
      'verify' => false,
      'timeout' => 10, // Tambahkan timeout!
    ]);

    try {
      $response = $client->post('https://sso.medan.go.id/api/website/v1/auth-user-sso', [
        'form_params' => [
          'client_id' => $clientId,
          'user_email' => $userEmail,
          'user_key' => $userKey,
        ],
      ]);

      $data = json_decode($response->getBody(), true);

      return isset($data['data']) ? $data : ['status' => false, 'message' => 'Data tidak valid dari SSO'];
    } catch (\Exception $e) {
      Log::error('SSO access token error', [
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
      ]);

      return [
        'status' => false,
        'message' => 'Tidak bisa konek ke SSO. Coba lagi nanti.',
      ];
    }
  }

  private function getauthCallBack($clientId, $accessToken)
  {
    $client = new Client([
      'verify' => false, // Menonaktifkan verifikasi SSL
    ]);
    $clientKey = '6h5BA0ABx9itEh57ehdwfW0TZq6N1BocpRn1DMhJxihbzr8Wzu2oxAPWKArzywdqX0MgyOZ19';
    try {
      $response = $client->post('https://sso.medan.go.id/api/website/v1/auth-client-callback-opd-app', [
        'headers' => [
          'Authorization' => 'Bearer ' . $accessToken,
          'Content-Type'  => 'application/x-www-form-urlencoded',
        ],
        'form_params' => [
          'client_id' => $clientId,
          'client_key' => $clientKey,

        ],
      ]);

      $data = json_decode($response->getBody(), true);

      if (isset($data['data'])) {
        return $data;
      }

      return null;
    } catch (\Exception $e) {
      // Log error or handle it accordingly
      $statusCode = $e->getCode(); // Kode status HTTP
      $responseBody = $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
      $responseData = json_decode($responseBody, true);

      $errorMessage = $responseData;
      return $errorMessage;
    }
  }


  private function saveNewUsernameSSo($clientId, $accessToken, $username_app)
  {
    $client = new Client([
      'verify' => false, // Menonaktifkan verifikasi SSL
    ]);
    $clientKey = '6h5BA0ABx9itEh57ehdwfW0TZq6N1BocpRn1DMhJxihbzr8Wzu2oxAPWKArzywdqX0MgyOZ19';
    try {
      $response = $client->post('https://sso.medan.go.id/api/website/v1/save-new-username-opd-app', [
        'headers' => [
          'Authorization' => 'Bearer ' . $accessToken,
          'Content-Type'  => 'application/x-www-form-urlencoded',
        ],
        'form_params' => [
          'client_id' => $clientId,
          'client_key' => $clientKey,
          'username_app' => $username_app,

        ],
      ]);

      $data = json_decode($response->getBody(), true);

      if (isset($data) && $data['status'] == true) {
        return $data;
      }

      return null;
    } catch (\Exception $e) {
      // Log error or handle it accordingly
      $statusCode = $e->getCode(); // Kode status HTTP
      $responseBody = $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
      $responseData = json_decode($responseBody, true);

      $errorMessage = $responseData;
      return $errorMessage;
    }
  }


  public function downloadAvatar($url)
  {
    // Set opsi konteks SSL untuk menonaktifkan verifikasi
    $contextOptions = [
      "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
      ],
    ];

    $context = stream_context_create($contextOptions);

    // Coba unduh file, kembalikan null jika gagal
    $contents = @file_get_contents($url, false, $context);

    // Jika gagal mengunduh atau URL tidak valid, kembalikan null
    if ($contents === false) {
      return null;
    }

    $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH)); // Mendapatkan informasi path dari URL
    $extension = isset($pathInfo['extension']) ? $pathInfo['extension'] : 'jpg'; // Mendapatkan ekstensi file, default ke 'jpg' jika tidak ada ekstensi
    $fileName = Str::random(10) . '.' . $extension; // Membuat nama file yang unik dengan ekstensi

    // Simpan file di storage/public/avatars
    Storage::disk('public')->put('avatars/' . $fileName, $contents);

    return 'avatars/' . $fileName;
  }
}
