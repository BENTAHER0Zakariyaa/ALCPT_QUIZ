<?php

namespace ALCPT_QUIZ;

class Result
{
    private $db;
    private $html;

    public function __construct()
    {
        $this->db = new Database("alcpt_quiz");
        $this->html = "";
    }

    public function showResult($TestId)
    {
        $data = $this->db->query("SELECT tests.testName, candidats.candidatLastname, candidats.candidatFirstName, candidats.candidatMatricule, candidats.candidatService, candidats.candidatRank, candidats.candidatCountry, candidats.candidatListening, candidats.candidatReading
                                    FROM candidats
                                    INNER JOIN tests ON candidats.candidatTestId=tests.testId
                                    WHERE candidats.candidatTestId = {$TestId}
                                    ORDER BY candidats.candidatListening DESC, candidats.candidatReading DESC")->result();
                                    
        $this->html ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <table >

        <style>
            .header{
                background-color:#000;
                color:white;
            }
            </style>
        <tr>
            <td colspan="2" style=min-width:50px>'.date("d-M-Y").'</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">ROYAME DU MAROC</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">FORCES ARMEES ROYALES</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">Forces Royales Air</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;"></td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style="min-width:50px;"></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;">Results</td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;" >...</td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;" >...</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
            <td class="header" style="min-width:50px;border: 1px solid black;">Order</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Country</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">First name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Last name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Rank</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">SCN</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Service</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Test Name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Listening score</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Reading score</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Final score</td>
        </tr>
        
        ';

        foreach ($data as $key => $r) {
            $this->html .='
            <tr>
            <td style="min-width:50px;border: 1px solid black;">'.($key+1).'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatCountry.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatFirstName.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatLastname.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatRank.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatMatricule.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatService.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->testName.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatListening.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatReading.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.($r->candidatListening + $r->candidatReading).'</td>
            </tr>';
        }
        $this->html.='</table>
        <div class="p-4">
            <a href="excel.php" class="btn btn-primary">Export to excel</a>
            <a href="deleteResult.php?testId='.$TestId.'" class="btn btn-primary">Clear result</a>
        </div></body>
        </html>';
        return $this->html;
    }
    public function export($TestId)
    {
        $data = $this->db->query("SELECT tests.testName, candidats.candidatLastname, candidats.candidatFirstName, candidats.candidatMatricule, candidats.candidatService, candidats.candidatRank, candidats.candidatCountry, candidats.candidatListening, candidats.candidatReading
                                    FROM candidats
                                    INNER JOIN tests ON candidats.candidatTestId=tests.testId
                                    WHERE candidats.candidatTestId = {$TestId}
                                    ORDER BY candidats.candidatListening DESC, candidats.candidatReading DESC")->result();
                                    
        $this->html ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <table>

        <style>
            .header{
                background-color:#000;
                color:white;
            }
            </style>
            <tr>
            <td colspan="2" style=min-width:50px>'.date("d-M-Y").'</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">ROYAME DU MAROC</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">FORCES ARMEES ROYALES</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;">Forces Royales Air</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td colspan="2" style="min-width:50px;text-align:center;"></td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style="min-width:50px;"></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;">Results</td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;" >...</td>
        </tr>
        <tr>
            <td colspan="11" style="min-width:50px;text-align:center;" >...</td>
        </tr>
        <tr>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
            <td class="header" style="min-width:50px;border: 1px solid black;">Order</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Country</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">First name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Last name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Rank</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">SCN</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Service</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Test Name</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Listening score</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Reading score</td>
            <td class="header" style="min-width:50px;border: 1px solid black;">Final score</td>
        </tr>
        
        ';

        foreach ($data as $key => $r) {
            $this->html .='
            <tr>
            <td style="min-width:50px;border: 1px solid black;">'.($key+1).'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatCountry.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatFirstName.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatLastname.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatRank.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatMatricule.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatService.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->testName.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatListening.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.$r->candidatReading.'</td>
            <td style="min-width:50px;border: 1px solid black;">'.($r->candidatListening + $r->candidatReading).'</td>
            </tr>';
        }
        $this->html.='</table>
        </body>
        </html>';
        return $this->html;
    }

}
?>
    
