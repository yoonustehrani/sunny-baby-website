import toastr from "toastr";
window.toastr = toastr;

document.addEventListener('livewire:initialized', () => {
  Livewire.on('alert', ({type, message}) => {
    toastr.options = {
      closeButton: false,
      debug: false,
      newestOnTop: true,
      progressBar: true,
      positionClass: "toast-bottom-right",
      preventDuplicates: false,
      onclick: null,
      showDuration: "300",
      hideDuration: "1000",
      timeOut: "3000",
      extendedTimeOut: "1000",
      showEasing: "swing",
      hideEasing: "linear",
      showMethod: "fadeIn",
      hideMethod: "fadeOut",
      rtl: true
    }
    toastr[type](message)
  })
})