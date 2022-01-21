<?php
// //koneksi ke database
include 'dbconnect.php';

$conn = mysqli_connect("localhost","root","","tekno_hfs");


// dibuat fungsi karena agar gampang melakukan query dengan berbeda halaman
function query($query){
    global $conn;

    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function queryitem($query){
    global $conn;

    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function deleteitem($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM produk WHERE idproduk=$id");

    return mysqli_affected_rows($conn);

}

function deletecustomer($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM login WHERE iduser=$id");

    return mysqli_affected_rows($conn);

}

function deletecategory($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM kategori_produk WHERE idkategori=$id");

    return mysqli_affected_rows($conn);

}

function additem($data){
    global $conn;
    $productname= htmlspecialchars($data["productname"]);
    $productcategory = htmlspecialchars($data["productcategory"]);
    $productprice = htmlspecialchars($data["productprice"]);
    $productweight = htmlspecialchars($data["productweight"]);
    $productdescription = htmlspecialchars($data["productdescription"]);
    $productstock = htmlspecialchars($data['productstock']);
     //jalankan fungsi upload gambar
    $productphoto = upload();

     if (!$productphoto) {
         return false;
     }
    

    //melakukan insert data
    $query = "INSERT INTO produk(idproduk,idkategori,namaproduk,hargaproduk,beratproduk,fotoproduk,deskripsiproduk,stock) VALUES
    ('',$productcategory,'$productname',$productprice,$productweight,'$productphoto','$productdescription',$productstock)";

    mysqli_query($conn,$query);
   

    return mysqli_affected_rows($conn);
}



function edititem($data){
    global $conn;
    $id = $data["id"];

    $productname= htmlspecialchars($data["productname"]);
    $productcategory = htmlspecialchars($data["productcategory"]);
    $productprice = htmlspecialchars($data["productprice"]);
    $productweight = htmlspecialchars($data["productweight"]);
    $productdescription = htmlspecialchars($data["productdescription"]);
    $productstock = htmlspecialchars($data['productstock']);
    $productoldphoto = htmlspecialchars($data["productoldphoto"]);

    //melakukan cek apakah user pilih gambar baru atau tidak
    if ($_FILES['productphoto']['error'] === 4) { // jika user tidak mengganti 
        $productphoto  = $productoldphoto ; 
    } else { //jika user mengganti gambar
        $productphoto = upload();
    }
     //jalankan fungsi upload gambar
   
    //  $productphoto = upload();

     if (!$productphoto) {
         return false;
     }
 
   
    //melakukan insert data
    $query = "UPDATE Produk SET
                namaproduk = '$productname',
                idkategori = $productcategory,
                hargaproduk = $productprice,
                beratproduk = $productweight,
                fotoproduk = '$productphoto',
                stock = $productstock ,
                deskripsiproduk = '$productdescription'
                
                WHERE idproduk = $id ";
  

    mysqli_query($conn,$query);

    //mengembalikan 1 jika sintaks insert $query benar dan -1 jika sintaks insert salah
    return mysqli_affected_rows($conn); 
}


function upload() {
    $nama_file = $_FILES['productphoto']['name'];
    $error = $_FILES['productphoto']['error'];
    $tmp_name = $_FILES['productphoto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar');
             </script>";
        return false;
    }
    move_uploaded_file($tmp_name,"../img/".$nama_file);

    return $nama_file;
}

function addpayment($data){
    global $conn;
    $idpem = htmlspecialchars($data['idpem']);
    $nama = htmlspecialchars($data["nama"]);
    $bank = htmlspecialchars($data["bank"]);
    $tanggal =  htmlspecialchars($data["date"]);
    
     //jalankan fungsi upload gambar
    $gambar = uploadgen();

     if (!$gambar) {
         return false;
     }
    

    //melakukan insert data
    $query = "INSERT INTO pembayaran(idpembayaran,idpembelian,nama,tanggal,bank,bukti) VALUES
    ('','$idpem','$nama','$tanggal','$bank','$gambar')";

    mysqli_query($conn,$query);
   

    return mysqli_affected_rows($conn);
}

function addphotoproduct($data){
    global $conn;
    $idpem = htmlspecialchars($data['idpem']);
    // $nama = htmlspecialchars($data["nama"]);
    // $bank = htmlspecialchars($data["bank"]);
    $tanggal =  htmlspecialchars($data["date"]);
    
     //jalankan fungsi upload gambar
    $gambar = uploadgen();

     if (!$gambar) {
         return false;
     }
    

    //melakukan insert data
    $query = "UPDATE pembayaran SET buktifoto = '$gambar',tanggalbultifoto = '$tanggal' WHERE idpembelian = $idpem";

    // $query = "INSERT INTO pembayaran(idpembayaran,idpembelian,nama,tanggal,bank,buktifoto) VALUES
    // ('','$idpem','$nama','$tanggal','$bank','$gambar')";

    mysqli_query($conn,$query);
   

    return mysqli_affected_rows($conn);
}

function uploadgen(){
    $nama_file = $_FILES['gambar']['name'];
    $error = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar');
             </script>";
        return false;
    }
    $daftarekstensigambar = ['jpeg','jpg','png'];
    $ekstensigambar = explode(".",$nama_file);
    $ekstensigambar = strtolower(end($ekstensigambar));

    //jika tidak ada gambar yang berekstensi file
    //in array digunakan untuk mencari eksetensi gambar seperti for loop python
    if (!in_array($ekstensigambar,$daftarekstensigambar)) {
        echo    "<script>
                alert('gambar tidak bereksetensi jpg,jpeg,png');
                </script>";
        return false;
    }

    $nama_filebaru = uniqid();
    $nama_filebaru .= '.';
    $nama_filebaru .= $ekstensigambar;
    move_uploaded_file($tmp_name,'img/'.$nama_filebaru);

    return $nama_filebaru; 
}

function cari_data($cari_data){
    $query = "SELECT * FROM produk WHERE 
                namaproduk LIKE '%$cari_data%' OR
                hargaproduk LIKE '%$cari_data%' OR
                ";


    return query($query);
}


function addbuyer($data){
    global $conn;
    
    $iduser = htmlspecialchars($data['iduser']);
    $idongkir = htmlspecialchars($data['idongkir']);
    $tglbeli = htmlspecialchars($data['tglbeli']);
    $totalpembelian = htmlspecialchars($data['totalpembelian']);
    $tarif = htmlspecialchars($data['tarif']);
    $alamat = htmlspecialchars($data['alamat']);
    

    $query = "INSERT INTO pembelian(idpembelian,iduser,idongkir,tanggal_pembelian,
    total_pembelian,tarif,alamat)
    VALUES ('','$iduser','$idongkir','$tglbeli','$totalpembelian',$tarif,'$alamat') ";
    mysqli_query($conn,$query);

     //mengembalikan 1 jika sintaks insert $query benar dan -1 jika sintaks insert salah
    return mysqli_affected_rows($conn); 
}


?>