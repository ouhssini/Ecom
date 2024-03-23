let password = document.querySelector("#password");
let passwordtoggle = document.querySelector("#password-toggle");

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

if (passwordtoggle) {
  passwordtoggle.addEventListener("click", () => {
    if (password.type === "password") {
      password.type = "text";
      passwordtoggle.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>';
    } else {
      password.type = "password";
      passwordtoggle.innerHTML = '<ion-icon name="eye-outline"></ion-icon>';
    }
  });
}
