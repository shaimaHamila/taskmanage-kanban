import "./bootstrap";
document.addEventListener("alert", (event) => {
    console.log("Alert event triggered", event.detail);
    let data = event.detail[0];
    Swal.fire({
        icon: data.type,
        title: data.message,
        position: data.position ?? "center",
        showConfirmButton: false,
        timer: data.timer ?? 2000,
    });
});
