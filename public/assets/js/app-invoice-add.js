$(function () {
  var applyChangesBtn = $('.btn-apply-changes'),
    discount,
    tax1,
    tax2,
    discountInput,
    tax1Input,
    tax2Input,
    sourceItem = $('.source-item'),
    adminDetails = {
      'App Design': 'Designed UI kit & app pages.',
      'App Customization': 'Customization & Bug Fixes.',
      'ABC Template': 'Bootstrap 4 admin template.',
      'App Development': 'Native App Development.'
    };

  // Show add input button when "Pilihan" is selected

  window.removeInputField = function (button) {
    $(button).closest('.form-floating').remove();
  };
  // Function to add input fields
  window.addInputField = function (repeaterWrapper) {
    var inputContainer = $(repeaterWrapper).find('#input-container');
    var newInputField = `
      <div class="form-floating form-floating-outline mt-2">
        <input type="text" name="additional_name_label[]" class="form-control" placeholder="Pilihan Baru">
        <label for="additional_name_label">Pilihan Baru</label>
         <!-- Tombol hapus untuk input field -->
        <button type="button" class="btn btn-sm btn-danger position-absolute end-0 top-0 mt-2 me-2" onclick="removeInputField(this)">X</button>
      </div>`;
    inputContainer.append(newInputField);
  };

  // Event handler for "Tambah Pilihan" button
  $(document).on('click', '#add-input-btn button', function () {
    var $repeaterWrapper = $(this).closest('.repeater-wrapper');
    addInputField($repeaterWrapper);
  });

  // Prevent dropdown from closing on tax change
  $(document).on('click', '.tax-select', function (e) {
    e.stopPropagation();
  });

  // Function to update IDs and 'for' attributes
  function updateIdsAndFors(container) {
    container.find('[id]').each(function () {
      let originalId = $(this).attr('id');
      let newId = originalId + '-' + Math.floor(Math.random() * 10000); // Generate a unique ID
      $(this).attr('id', newId);

      // Update corresponding label's `for` attribute
      let label = container.find('label[for="' + originalId + '"]');
      if (label.length) {
        label.attr('for', newId);
      }
    });
  }

  // On tax change update its value
  function updateValue(listener, el) {
    listener.closest('.repeater-wrapper').find(el).text(listener.val());
  }

  // Apply item changes btn
  if (applyChangesBtn.length) {
    $(document).on('click', '.btn-apply-changes', function (e) {
      var $this = $(this);
      tax1Input = $this.closest('.dropdown-menu').find('#taxInput1');
      tax2Input = $this.closest('.dropdown-menu').find('#taxInput2');
      discountInput = $this.closest('.dropdown-menu').find('#discountInput');
      tax1 = $this.closest('.repeater-wrapper').find('.tax-1');
      tax2 = $this.closest('.repeater-wrapper').find('.tax-2');
      discount = $('.discount');

      if (tax1Input.val() !== null) {
        updateValue(tax1Input, tax1);
      }

      if (tax2Input.val() !== null) {
        updateValue(tax2Input, tax2);
      }

      if (discountInput.val().length) {
        $this
          .closest('.repeater-wrapper')
          .find(discount)
          .text(discountInput.val() + '%');
      }
    });
  }

  // Repeater init
  if (sourceItem.length) {
    sourceItem.repeater({
      show: function () {
        $(this).slideDown();
        updateIdsAndFors($(this));
        // Initialize tooltip on load of each item
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
      },
      hide: function (e) {
        $(this).slideUp(function () {
          $(this).remove();
        });
      }
    });
  }

  // Item details select onchange
  $(document).on('change', '.item-details', function () {
    var $this = $(this),
      value = adminDetails[$this.val()];
    if ($this.next('textarea').length) {
      $this.next('textarea').val(value);
    } else {
      $this.after('<textarea class="form-control" rows="2">' + value + '</textarea>');
    }
  });
});
