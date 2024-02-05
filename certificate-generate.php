<?php
require_once('tcpdf/tcpdf.php');

function generateCertificate($name) {
    

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Remove right and bottom space
    $pdf->SetAutoPageBreak(false, 0);

    // Font styling of user's name
    $pdf->SetFont('timesI', '', 48);
    $pdf->AddPage();

    // GIVEN TEMPLATE
    $certificateTemplate = 'Ordination-Certificate.jpg';
    $pdf->Image($certificateTemplate, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    $pdf->SetXY(50, 125);

    // Printing dynamic name
    $html = '<span style="letter-spacing: 2px;background-color:white;color:#575654;">&nbsp;'.htmlspecialchars($name).'&nbsp;</span>';
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // pdf output in preview mode
    $pdf->Output('certificate.pdf', 'I');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = isset($_POST['name']) ? $_POST['name'] : '';

    generateCertificate($userName);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator</title>
</head>
<body>

    <h1>Generate Certificate</h1>
    
    <form method="POST" action="">
        <label for="name">Enter Your Full Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Generate Certificate</button>
    </form>

</body>
</html>
