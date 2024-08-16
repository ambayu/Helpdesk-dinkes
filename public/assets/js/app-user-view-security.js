'use strict';

(function () {
  const formChangePass = document.querySelector('#formChangePassword');
  console.log('Form submission triggered'); // Debugging statement to check if the function is called

  function submitChangePasswordForm(event) {
    event.preventDefault();

    console.log('Form submission triggered'); // Debugging statement to check if the function is called

    if (fv) {
      fv.validate().then(function (status) {
        if (status === 'Valid') {
          console.log('Form is valid, submitting now'); // Debugging statement to confirm validation passed
          formChangePass.submit();
        } else {
          console.log('Form validation failed'); // Debugging statement if validation fails
        }
      });
    } else {
      console.log('Form validation instance not found'); // Debugging statement if fv is not found
    }
  }

  // Form validation for Change password
  if (formChangePass) {
    var fv = FormValidation.formValidation(formChangePass, {
      fields: {
        newPassword: {
          validators: {
            notEmpty: {
              message: 'Please enter new password'
            },
            stringLength: {
              min: 8,
              message: 'Password must be more than 8 characters'
            }
          }
        },
        confirmPassword: {
          validators: {
            notEmpty: {
              message: 'Please confirm new password'
            },
            identical: {
              compare: function () {
                return formChangePass.querySelector('[name="newPassword"]').value;
              },
              message: 'The password and its confirm are not the same'
            },
            stringLength: {
              min: 8,
              message: 'Password must be more than 8 characters'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.form-password-toggle'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  }
})();
