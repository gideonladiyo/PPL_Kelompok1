function addToCart(id_menu) {
    var jumlah = document.getElementById("input-number").value; // Ambil nilai jumlah
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php?mod=addToChart", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respon dari server
            console.log(xhr.responseText);
            // Anda bisa menambahkan logika tambahan di sini, misalnya menampilkan pesan berhasil, memperbarui keranjang, dll.
        }
    }
    xhr.send("id_menu=" + id_menu + "&jumlah=" + jumlah);
}
