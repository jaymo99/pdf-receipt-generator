<?php

require('fpdf185/fpdf.php');

class PDF extends FPDF
{
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT user_id, f_name, l_name, phone FROM users";
$result = $conn->query($sql);

$header = array('user_id', 'f_name', 'l_name', 'phone');
$data = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = array($row["user_id"], $row["f_name"], $row["l_name"], $row["phone"]);
    }
} else {
    echo "0 results";
}

$conn->close();

$pdf = new FPDF();
$pdf->AddPage();
$font_size = 10;
$pdf->SetFont('Arial','',$font_size);

//Logo
$image_file = "Telkom-Kenya-Logo.jpg";

$pdf->SetX(10);
$pdf->SetY(10);
$pdf->Cell(50, 34, $pdf->Image($image_file, $pdf->GetX(), $pdf->GetY(), 50), 1, 0, 'C');
$pdf->SetFont('Arial','B',18);
$pdf->Cell(140,34,'Order No. 556684',1,0,'R');
$pdf->Ln(45);

//Date
$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(190,5,'Date: 2021/10/21',0,0, 'R');
$pdf->Ln(15);

// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,15,'Staff details',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Name',1,0);
$pdf->Cell(100,5,'KAGWI GEORGE',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'PFs number',1,0);
$pdf->Cell(100,5,'96217',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Department/Region',1,0);
$pdf->Cell(100,5,'MOBILE DIVISION',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,25,'Order details',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->MultiCell(40,5,'Device description',1,0);
$pdf->MultiCell(100,5,'Staff Offer - WATCH FIT - 1.64" Vivid AMOLED Display',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Device cost',1,0);
$pdf->Cell(100,5,'12199.00',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Order number',1,0);
$pdf->Cell(100,5,'1848213',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Payment mode',1,0);
$pdf->Cell(100,5,'Check Off 12 months',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Shop',1,0);
$pdf->Cell(100,5,'MERU',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,15,'HR approval',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Name',1,0);
$pdf->Cell(100,5,'Hellen Tum',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Approval date',1,0);
$pdf->Cell(100,5,'2021-10-21 12:45:33',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Comments',1,0);
$pdf->Cell(100,5,'validation 1',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,15,'Finance approval',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Name',1,0);
$pdf->Cell(100,5,'George Kanyua',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Approval date',1,0);
$pdf->Cell(100,5,'2021-10-21 13:55:29',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Comments',1,0);
$pdf->Cell(100,5,'Approved',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,30,'Device Collection Details ',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Device IMEI number',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Warranty (from - to)',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'DFP Rep. Name',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Signature',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Date',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'DFP Comments',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,30,'Staff Acceptance',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Name',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Signature',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'PF No./ID No.',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Date',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Department/Region',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Comments',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();


// row
$pdf->SetFont('Arial','B',$font_size);
$pdf->Cell(50,20,'Witness',1,0,'C');

$pdf->SetFont('Arial','',$font_size);
$pdf->Cell(40,5,'Shop manager Name',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(40,5,'Signature',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Date',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();
$pdf->Cell(50,30,'',0,0,'C');
$pdf->Cell(40,5,'Comments',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Ln();


$pdf->Output(); 