<!-- Include SmartWizard JavaScript source -->
<!-- Include jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>resources/wizard/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/wizard/js/jquery.smartWizard.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>resources/wizard/js/demo.js"></script>
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
  //const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
var stripe = Stripe("pk_test_51SPt1WHz56QdCFhGsjKLXIZ3aHN9dKdbcYCBJCH18HTppZRjW9Ieh3tUKdgBbUEdQ5S4EFQ6tLEsYeiZReFxcl1800gJRGbrrx");
var elements = stripe.elements();

var style = {
    base: {
        color: "#32325d",
        fontSize: "16px",
        fontFamily: "'Helvetica Neue', sans-serif",
        fontSmoothing: "antialiased",
        "::placeholder": {
            color: "#a0aec0"
        },
        padding: "12px 14px"
    },
    invalid: {
        color: "#e53e3e",
        iconColor: "#e53e3e"
    }
};

var card = elements.create('card', { style: style, hidePostalCode: true });
card.mount('#card-element');
//var card = elements.create("card");
//card.mount("#card-element");

  function onCancel() {
    // Reset wizard
    $('#smartwizard').smartWizard("reset");

    // Reset form
    document.getElementById("form-1").reset();
    document.getElementById("form-2").reset();
    document.getElementById("form-3").reset();
    document.getElementById("form-4").reset();
  }
 
  function onConfirm() {
   
    let form = document.getElementById('form-4');
    
        //console.log(result);
    if (form) {
      if (!form.checkValidity()) {
        form.classList.add('was-validated');
        $('#smartwizard').smartWizard("setState", [3], 'error');
        $("#smartwizard").smartWizard('fixHeight');
        return false;
      } else{
        //createToken();
     stripe.createPaymentMethod({
        type: 'card',
        card: card
    }).then(function(result) {

        if (result.error) {
            $("#payment-errors").text(result.error.message);
        } else {
            $("#payment_method").val(result.paymentMethod.id);
           var dataString = $("#form-1, #form-2, #form-3, #form-4").serialize();
           console.log(result);
        $.ajax({
                url: '<?php echo site_url('Bookconsultation/payment'); ?>',
                type: "post",
                data: dataString,
                // processData: false,
                // contentType: false,
                // cache: false,
                // async: false,
                beforeSend: function() {
                    $(".classify-save").text("Wait...");
                },
                success: function(data) {
                    //alert(data);
                     console.log(data);
                     if(data == "success"){
                        window.location = "<?php echo base_url('Bookconsultation/success_message/'); ?>";
                      } else {
                         window.location = "<?php echo base_url('Bookconsultation/fail_message/'); ?>";
                      }
                    //window.location = "<?php echo base_url('Employer/Jobs/checkout/'); ?>" + data;
                },
                //error: function (result) { console.log("Error : "+result); }
            });
             }
        });
      }

      $('#smartwizard').smartWizard("unsetState", [3], 'error');
      //myModal.show();
    }
  }
 
  // function closeModal() {
  //   // Reset wizard
  //   $('#smartwizard').smartWizard("reset");

  //   // Reset form
  //   document.getElementById("form-1").reset();
  //   document.getElementById("form-2").reset();
  //   document.getElementById("form-3").reset();
  //   document.getElementById("form-4").reset();

  //   myModal.hide();
  // }

  function showConfirm() {
    $('#smartwizard').smartWizard("setOption", "autoAdjustHeight", true);
  }

  $(function() {
    // Leave step event is used for validating the forms
    $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
      // Validate only on forward movement  
      if (stepDirection == 'forward') {
        
        let form = document.getElementById('form-' + (currentStepIdx + 1));
        console.log(currentStepIdx);
        if (form) {
          // Validate only Step 1
        
          if (!form.checkValidity()) {
            form.classList.add('was-validated');
            $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
            $("#smartwizard").smartWizard('fixHeight');
            return false;
          }
          
          $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
          if (currentStepIdx === 1) {
            let email = $("#email").val().trim();
            let phone = $("#phone").val().trim();
            let valid = true;
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let phonePattern = /^[0-9]{10}$/; // 10-digit validation

            // Reset previous styles
            $("#email, #phone").css("border", "1px solid #ccc");

            if (!emailPattern.test(email)) {
                valid = false;
                $("#email").css("border", "2px solid red");
                 //$("#email").after(empty);
                $("#email").after("<small style='color:red'>Please enter a valid email address.</small>");
                //alert("Please enter a valid email address.");
            } else if (!phonePattern.test(phone)) {
                valid = false;
                $("#phone").css("border", "2px solid red");
                //$("#phone").after(empty);
                $("#phone").after("<small style='color:red'>Please enter a valid 10-digit phone number.</small>");
                //alert("Please enter a valid 10-digit phone number.");
            }

            // Stop moving to the next step
            if (!valid) return false;
        }
        }
      }
    });

    // Step show event
    $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
      $("#prev-btn").removeClass('disabled').prop('disabled', false);
      $("#next-btn").removeClass('disabled').prop('disabled', false);
      if (stepPosition === 'first') {
        $("#prev-btn").addClass('disabled').prop('disabled', true);
      } else if (stepPosition === 'last') {
        $("#next-btn").addClass('disabled').prop('disabled', true);
      } else {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
      }

      // Get step info from Smart Wizard
      let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
      $("#sw-current-step").text(stepInfo.currentStep + 1);
      $("#sw-total-step").text(stepInfo.totalSteps);

      if (stepPosition == 'last') {
        showConfirm();
        $("#btnFinish").prop('disabled', false);
      } else {
        $("#btnFinish").prop('disabled', true);
      }

      // Focus first name
      if (stepIndex == 1) {
        setTimeout(() => {
          $('#first-name').focus();
        }, 0);
      }
    });

    // Smart Wizard
    $('#smartwizard').smartWizard({
      selected: 0,
      // autoAdjustHeight: false,
      theme: 'round', // basic, arrows, square, round, dots
      transition: {
        animation: 'none'
      },
      toolbar: {
        showNextButton: true, // show/hide a Next button
        showPreviousButton: true, // show/hide a Previous button
        position: 'bottom', // none/ top/ both bottom
        extraHtml: `<button class="btn btn-success classify-save" type="submit" id="btnFinish" disabled onclick="onConfirm()">Complete Booking</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
      },
      anchor: {
        enableNavigation: true, // Enable/Disable anchor navigation 
        enableNavigationAlways: false, // Activates all anchors clickable always
        enableDoneState: true, // Add done state on visited steps
        markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
        unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
        enableDoneStateNavigation: true // Enable/Disable the done state navigation
      },
    });

    $("#state_selector").on("change", function() {
      $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
      return true;
    });

    $("#style_selector").on("change", function() {
      $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
      return true;
    });

  });
</script>