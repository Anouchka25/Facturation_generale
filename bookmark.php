<?php
$html .= '
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
    h1 {color: #000033}
    h2 {color: #000055}
    h3 {color: #000077}

    div.standard
    {
        padding-left: 5mm;
    }
-->
</style>
<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; text-align: left">
                    Example of using bookmarks
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 100%; text-align: right">
                    page [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    <bookmark title="Chapter 1" level="0" ></bookmark><h1>Chapter 1</h1>
    <div class="standard">
        Contents of Chapter 1
    </div>
</page>
<page pageset="old">
    <bookmark title="Chapter 2" level="0" ></bookmark><h1>Chapter 2</h1>
    <div class="standard">
        Intro to Chapter 2
        <bookmark title="Chapter 2.1" level="1" ></bookmark><h2>Chapter 2.1</h2>
        <div class="standard">
            Contents of Chapter 2.1
        </div>
        <bookmark title="Chapter 2.2" level="1" ></bookmark><h2>Chapter 2.2</h2>
        <div class="standard">
            Contents of Chapter 2.2
        </div>
        <bookmark title="Chapter 2.3" level="1" ></bookmark><h2>Chapter 2.3</h2>
        <div class="standard">
            Contents of Chapter 2.3
        </div>
    </div>
</page>
<page pageset="old">
    <bookmark title="Chapter 3" level="0" ></bookmark><h1>Chapter 3</h1>
    <div class="standard">
        Intro to Chapter 3
        <bookmark title="Chapter 3.1" level="1" ></bookmark><h2>Chapter 3.1</h2>
        <div class="standard">
            Contents of Chapter 3.1
        </div>
        <bookmark title="Chapter 3.2" level="1" ></bookmark><h2>Chapter 3.2</h2>
        <div class="standard">
            Intro to Chapter 3.2
            <bookmark title="Chapter 3.2.1" level="2" ></bookmark><h3>Chapter 3.2.1</h3>
            <div class="standard">
                Contents of Chapter 3.2.1
            </div>
            <bookmark title="Chapter 3.2.2" level="2" ></bookmark><h3>Chapter 3.2.2</h3>
            <div class="standard">
                Contents of Chapter 3.2.2
            </div>
        </div>
    </div>
</page>
';

require_once dirname(__FILE__).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
$html2pdf->writeHTML($html);
$html2pdf->createIndex('Summary', 25, 12, true, true);
$html2pdf->output();
