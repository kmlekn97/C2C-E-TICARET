<?php         

require('fpdf.php');
require('../nedmin/netting/baglan.php');
require('../nedmin/netting/class.crud-guncel.php');
require('../services/faturaServices.php');

class PDF extends FPDF
{

        // Sayfa başlığı
    function Header()
    {
        $dbsql=new crud();
        $faturadbservices=new faturaServices($dbsql);
        $logocek=$faturadbservices->ayarGetir();
        $logo="../".$logocek['ayar_logo'];

            // Logo ayarlanır
        $this->Image($logo,10,6,50);

            // Yazı rengi ayarlanır
        $this->SetTextColor(0,0,140);

            // Satır 25 pixel içeriden başlasın
        $this->Cell(105);
        $this->SetFont('Arial','',50); 

            // Satıra yazı yazılır
        $this->Write (15, 'Fatura'); 

            // 4 pixel aşağıda yeni satıra geç
        $this->Ln(4);

            // Satır 25 pixel içeriden başlasın
        $this->SetFont('Arial','',7); 
        $this->Cell(164);  

        $this->Write (15, $_GET['siparis_zaman']); 

            // Arial italic 8
        $this->SetFont('Arial','',8); 
            // Yazı rengi ayarlanır 
        $this->SetTextColor(51,0,102);
            // Satıra yazı yazılır
            // 15 pixel aşağıda yeni satıra geç
        $this->Ln(5);

            // Satır 25 pixel içeriden başlasın 
        $this->Cell(65);  

            // Satıra yazı yazılır
            // 10 pixel aşağıda yeni satıra geç
        $this->Ln(10);

            // X koordinatı
        $x = $this->GetX();
            // Y Koordinatı 
        $y = $this->GetY();
            // Düz çizgi çizilir
        $this->Line( $x, $y , $x + 185, $y ); 

            // 5 pixel aşağıda yeni satıra geç 
        $this->Ln(5);
    }

        // Sayfa Altı
    function Footer()
    {
            // 15 pıxel sayfa altından yukarıda başla
        $this->SetY(-15);
            // Arial italic 8
        $this->SetFont('Arial','I',8);
            // Sayfa Numarası
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

        // Renkli tablo
    function FancyTable($header, $data)
    {

            // Renkler ve yükseklikler ayarlanır
        $this->SetFillColor(51,153,255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);

            // Satırın X ve Y koordinatları alınır
        $posX = $this->GetX();
        $posY = $this->GetY();

            // Yazı fontu ayarlanır
        $this->SetFont('Arial','',12); 

            // Tablonun en üst satırı (başlık kısmı)
            // Her kolonun pixel boyutu ayarlanır
        $w = array(30, 25, 25);
        for($i=0;$i<count($header);$i++)
        {          
            $this->MultiCell($w[$i],6,$header[$i],1,'C',true);
                // Bir sonraki hücrenin X koordinatı bir önceki kolonun pixel sayısı eklenerek hesaplanır
            $posX +=  $w[$i];

            $this->SetXY($posX, $posY);
        }

        $this->Ln(12);

        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);

            // Bilgiler
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'R',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
            // Satır kapatılır
        $this->Cell(array_sum($w),0,'','T');
    } 
    function vcell($c_width,$c_height,$x_axis,$text){
        $w_w=$c_height/4    ;
        $w_w_1=$w_w+2;
        $w_w1=$w_w+$w_w+$w_w+3;
$len=strlen($text);// check the length of the cell and splits the text into 7 character each and saves in a array 

$lengthToSplit = 28;
if($len>$lengthToSplit){
    $w_text=str_split($text,$lengthToSplit);
    $this->SetX($x_axis);
    $this->Cell($c_width,$w_w_1,$w_text[0],'','','');
    if(isset($w_text[1])) {
        $this->SetX($x_axis);
        $this->Cell($c_width,$w_w1,$w_text[1],'','','');

        if(isset($w_text[2])) {
            $this->SetX($x_axis);
            $this->Cell($c_width,$w_w1+12,$w_text[2],'','','');
            
        }

    }


    $this->SetX($x_axis);
    $this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
}
else{
    $this->SetX($x_axis);
    $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);}
} 
}
function turkce($k)
{
    return iconv('utf-8','iso-8859-9',$k);
}
$dbsqlfatura=new crud();
$faturadbservices=new faturaServices($dbsqlfatura);
$siparissor=$faturadbservices->SaticiFaturaSiparisone();
$siparissor2=$faturadbservices->SaticiFaturaSiparissecond();

$dbsql=new crud();
$ayarcek=$faturadbservices->ayarGetir();

    // Pdf nesnesi oluşturulur
$pdf = new PDF();



$pdf->AddPage();
    // Sayfa altýnda numaralarý göstermek için kullanýlýr
$pdf->AliasNbPages();



$pdf->AddFont('arial_tr','','arial_tr.php');
$pdf->AddFont('arial_tr','B','arial_tr_bold.php');
$pdf->SetFont('arial_tr','',8);
$pdf->Write(7,turkce($ayarcek['ayar_title']));
$pdf->Ln(); 
$pdf->Write(7,turkce('Şirket Adresi:         '));    
$pdf->Write(7,turkce($ayarcek['ayar_adres']));
$pdf->Ln(); 
$pdf->Write(7,turkce('Tel:                        '));   
$pdf->Write(7,turkce($ayarcek['ayar_tel']));
$pdf->Ln(); 
$pdf->Write(7,turkce('E-Posta:                ')); 
$pdf->Write(7,turkce($ayarcek['ayar_mail']));
$pdf->Ln(); 
$pdf->Write(7,turkce('Vergi Dairesi:        '));  
$pdf->Write(7,turkce($ayarcek['vergi_dairesi']));
$pdf->Ln(); 
$pdf->Write(7,turkce('VDS:                     '));  
$pdf->Write(7,turkce($ayarcek['vds']));


$pdf->Ln(); 
$pdf->Ln(); 


$pdf->Line(10,80 ,195,80 ); 
$sipariscekkullanici=$faturadbservices->vericek($siparissor2);
$pdf->Write(7,turkce("Sayın "));
$pdf->Write(7,turkce(ucwords($sipariscekkullanici['kullanici_ad'])));
$pdf->Write(7,turkce(" "));
$pdf->Write(7,turkce(mb_strtoupper($sipariscekkullanici['kullanici_soyad'])));
$pdf->Ln(); 
$pdf->Write(7,turkce("Alıcı Adres:        ".$sipariscekkullanici['kullanici_adres']." ".$sipariscekkullanici['kullanici_il']. " / ".$sipariscekkullanici['kullanici_ilce']));
$pdf->Ln(); 
$pdf->Write(7,turkce("Alıcı Tel:            ".$sipariscekkullanici['kullanici_gsm']));
$pdf->Ln(); 
$pdf->Write(7,turkce("Alıcı E-Mail:       ".$sipariscekkullanici['kullanici_mail']));
$pdf->Line(10,110 ,195,110 ); 
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->Ln();
$pdf->SetFont('arial_tr','',14);

$say=0;

$toplam=0;
$toplamkdv=0;
    // Baþlýk için array olusturulur
$width_cell=array(7,50,25,30,12,15,20, 30);

$pdf->SetFillColor(193,229,252);
$pdf->Cell($width_cell[0],25,'#',1,0,true);
$pdf->Cell($width_cell[1],25,turkce('Ürün Adı'),1,0,true); 
$pdf->Cell($width_cell[2],25,'Marka',1,0,true);
$pdf->Cell($width_cell[3],25,'Fiyat',1,0,true);
$pdf->Cell($width_cell[4],25,'Adet',1,0,true);
$pdf->Cell($width_cell[5],25,'%Kdv',1,0,true);
$pdf->Cell($width_cell[6],25,'Kdv',1,0,true);
$pdf->Cell($width_cell[7],25,'Ara Top',1,1,true);
while($sipariscek=$faturadbservices->vericek($siparissor)) {
    $toplamkdv+=(($sipariscek['urun_kdv']*$sipariscek['satis_fiyat'])/100)*$sipariscek['urun_adet'];
    $toplam+=$sipariscek['urun_adet']*$sipariscek['satis_fiyat'];
    $markacek=$faturadbservices->MarkaListele($sipariscek['marka_id']);
    $renkcek=$faturadbservices->RenkListele($sipariscek['renk_id']);
    $bedencek=$faturadbservices->BedenListele($sipariscek['beden_id']);
    $pdf->SetFont('arial_tr','',10);
    $pdf->Cell($width_cell[0],25,++$say,1,0,false); 
    $pdf->vcell($width_cell[1],25,$pdf->getx(),turkce($sipariscek['barkod_no']." ".$renkcek['renk_adi']." ".$sipariscek['urun_ad']." ".$bedencek['beden_icerik']));
    $pdf->Cell($width_cell[2],25,turkce($markacek['marka_adi']),1,0,false);
    $pdf->Cell($width_cell[3],25,number_format($sipariscek['satis_fiyat'], 2, ',', '.')." T.L." ,1,0,false);
    $pdf->Cell($width_cell[4],25,turkce($sipariscek['urun_adet']),1,0,false);
    $pdf->Cell($width_cell[5],25,turkce($sipariscek['urun_kdv']),1,0,false);
    $pdf->Cell($width_cell[6],25,number_format(($sipariscek['urun_kdv']*$sipariscek['satis_fiyat'])/100, 2, ',', '.')." T.L.",1,0,false);
    $pdf->Cell($width_cell[7],25,number_format($sipariscek['urun_adet']*$sipariscek['satis_fiyat'], 2, ',', '.')." T.L.",1,1,false);
    $zaman=$sipariscek['siparis_zaman'];
}
$pdf->Write(10,turkce('Bu Fatura Satış Faturası amacıyla '.$zaman." tarihinde düzenlenmiştir."));
$pdf->Ln(); 

$pdf->Cell(100); 
$pdf->Write(10,turkce('KDV:                        '));
$pdf->Write(10,turkce(number_format($toplamkdv, 2, ',', '.')." T.L."));
$pdf->Ln(); 
$pdf->Cell(100); 


$pdf->Write(10,turkce('Ara Toplam:            '));    
$pdf->Write(10,turkce(number_format($toplam-$toplamkdv, 2, ',', '.')." T.L."));

$pdf->Ln(); 
$pdf->Cell(100); 

$pdf->Write(10,turkce('Genel Toplam:        '));    
$pdf->Write(10,turkce(number_format($toplam, 2, ',', '.')." T.L."));


$pdf->Output();     
?>