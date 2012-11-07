<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('style');
        echo $this->Html->script('http://code.jquery.com/jquery-1.8.2.min.js');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div class="back" style="font-size: 18px;top: 100px;left:100px">IEEE: The Institute of Electrical and Electronics Engineers</div>
        <div class="back" style="font-size: 26px;top: 450px;left:800px">USB: Universal Serial Bus</div>
        <div class="back" style="font-size: 42px;top: 190px;left:630px">PHP: Personal Home Page Hypertext Processor</div>
        <div class="back" style="font-size: 32px;top: 780px;left:650px">IMF: International Monetary Fund</div>
        <div class="back" style="font-size: 54px;top: 340px;left:-10px">ODA: Official Development Assistance</div>
        <div class="back" style="font-size: 91px;top: 650px;left:100px">ICPO: International Criminal Police Organization</div>
        <div class="back" style="font-size: 18px;top: 300px;left:200px">HTML: HyperText Markup Language</div>
        <div class="back" style="font-size: 18px;top: 10px;left:450px">ASEAN: Association of South‐East Asian Nations</div>
        <div class="back" style="font-size: 72px;top: 80px;left:611px">ACPI: Advanced Configuration and Power Interface</div>
        <div class="back" style="font-size: 32px;top: 300px;left:950px">EEC: European Economic Community</div>
        <div class="back" style="font-size: 18px;top: 570px;left:480px">SATA: Serial Advanced Technology Attachment</div>
        <div class="back" style="font-size: 18px;top: 405px;left:706px">SCSI: Small Computer System Interface</div>
        <div class="back" style="font-size: 42px;top: 234px;left:-100px">NATO: North Atlantic Treaty Organization</div>
        <div class="back" style="font-size: 74px;top: 468px;left:450px">NIEs: Newly Industrializing Economies</div>
        <div class="back" style="font-size: 74px;top: 900px;left:301px">TDP: Thermal Design Power</div>
        <div class="back" style="font-size: 24px;top: 278px;left:768px">ATP: Adenosine TriPhosphate</div>
        <div class="back" style="font-size: 18px;top: 800px;left:150px">SBD: Schottky Barrier Diode</div>
        <div class="back" style="font-size: 24px;top: 602px;left:50px">EDLC: Electric Double-Layer Capacitor</div>
        <div class="back" style="font-size: 36px;top: 572px;left:1000px">ODBC: Open Database Connectivity</div>
        <div class="back" style="font-size: 24px;top: 387px;left:1200px">LINQ: Language INtegrated Query</div>
        <div class="back" style="font-size: 18px;top: 460px;left:150px">ORM: Object-Relational Mapping</div>
        <div class="back" style="font-size: 32px;top: 302px;left:1800px">UDP: User Datagram Protocol</div>
        <div class="back" style="font-size: 45px;top: 415px;left:1535px">DNA: DeoxyriboNucleic Acid</div>
        <div id="container">
            <div id="header">
                <h1>略.tk</h1>
                <h2>長いなら略せばいいじゃん</h2>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">

            </div>
        </div>
    </body>
</html>
