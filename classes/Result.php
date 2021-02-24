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
        $data = $this->db->query("SELECT tests.testName, candidats.candidatLastname, candidats.candidatFistname, candidats.candidatMatricule, candidats.candidatService, candidats.candidatRank, candidats.candidatCountry, scores.listening, scores.reading
                                    FROM scores
                                    INNER JOIN tests ON scores.testId=tests.testId
                                    INNER JOIN candidats ON scores.candidatId=candidats.candidatId
                                    ORDER BY scores.listening ASC, scores.reading ASC")->result();
                                    
        $this->html ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <table cellspacing=0 border=1>

        <style>
            table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
            .header{
                background-color:#006400;
                color:white;
            }
            </style>
        <tr>
            <td style=min-width:50px>Salé le, '.date("d-M-Y").'</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px>ROYAME DU MAROC</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>FORCES ARMEES ROYALES</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>Forces Royales Air</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>1°BA/FRA</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>EPL</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style="min-width:50px;text-align:center;">Results</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px>..............................</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px>..............................</td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
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
            <td class="header" style=min-width:50px>Order</td>
            <td class="header" style=min-width:50px>Country</td>
            <td class="header" style=min-width:50px>First name</td>
            <td class="header" style=min-width:50px>Last name</td>
            <td class="header" style=min-width:50px>Rank</td>
            <td class="header" style=min-width:50px>Mle</td>
            <td class="header" style=min-width:50px>Service</td>
            <td class="header" style=min-width:50px>Test Name</td>
            <td class="header" style=min-width:50px>listening score</td>
            <td class="header" style=min-width:50px>Reading score</td>
            <td class="header" style=min-width:50px>Final score</td>
        </tr>
        
        ';

        foreach ($data as $key => $r) {
            $this->html .='
            <tr>
            <td style=min-width:50px>'.($key+1).'</td>
            <td style=min-width:50px>'.$r->candidatCountry.'</td>
            <td style=min-width:50px>'.$r->candidatFistname.'</td>
            <td style=min-width:50px>'.$r->candidatLastname.'</td>
            <td style=min-width:50px>'.$r->candidatRank.'</td>
            <td style=min-width:50px>'.$r->candidatMatricule.'</td>
            <td style=min-width:50px>'.$r->candidatService.'</td>
            <td style=min-width:50px>'.$r->testName.'</td>
            <td style=min-width:50px>'.$r->listening.'</td>
            <td style=min-width:50px>'.$r->reading.'</td>
            <td style=min-width:50px>'.($r->listening + $r->reading).'</td>
            </tr>';
        }
        $this->html.='</table>
        <div class="p-4">
            <a href="excile.php" class="btn btn-primary">Export excile</a>
        </div></body>
        </html>';
        return $this->html;
    }
    public function export($TestId)
    {
        $data = $this->db->query("SELECT tests.testName, candidats.candidatLastname, candidats.candidatFistname, candidats.candidatMatricule, candidats.candidatService, candidats.candidatRank, candidats.candidatCountry, scores.listening, scores.reading
                                    FROM scores
                                    INNER JOIN tests ON scores.testId=tests.testId
                                    INNER JOIN candidats ON scores.candidatId=candidats.candidatId
                                    ORDER BY scores.listening ASC, scores.reading ASC")->result();
                                    
        $this->html ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <table cellspacing=0 border=1>

        <style>
            table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
            .header{
                background-color:#006400;
                color:white;
            }
            </style>
        <tr>
            <td style=min-width:50px>Salé le, '.date("d-M-Y").'</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px>ROYAME DU MAROC</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>FORCES ARMEES ROYALES</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>Forces Royales Air</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>1°BA/FRA</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
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
            <td style=min-width:50px>EPL</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style="min-width:50px;text-align:center;">Results</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px>..............................</td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
            <td style=min-width:50px></td>
        </tr>
        <tr>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px>..............................</td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
        <td style=min-width:50px></td>
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
            <td class="header" style=min-width:50px>Order</td>
            <td class="header" style=min-width:50px>Country</td>
            <td class="header" style=min-width:50px>First name</td>
            <td class="header" style=min-width:50px>Last name</td>
            <td class="header" style=min-width:50px>Rank</td>
            <td class="header" style=min-width:50px>Mle</td>
            <td class="header" style=min-width:50px>Service</td>
            <td class="header" style=min-width:50px>Test Name</td>
            <td class="header" style=min-width:50px>listening score</td>
            <td class="header" style=min-width:50px>Reading score</td>
            <td class="header" style=min-width:50px>Final score</td>
        </tr>
        
        ';

        foreach ($data as $key => $r) {
            $this->html .='
            <tr>
            <td style=min-width:50px>'.($key+1).'</td>
            <td style=min-width:50px>'.$r->candidatCountry.'</td>
            <td style=min-width:50px>'.$r->candidatFistname.'</td>
            <td style=min-width:50px>'.$r->candidatLastname.'</td>
            <td style=min-width:50px>'.$r->candidatRank.'</td>
            <td style=min-width:50px>'.$r->candidatMatricule.'</td>
            <td style=min-width:50px>'.$r->candidatService.'</td>
            <td style=min-width:50px>'.$r->testName.'</td>
            <td style=min-width:50px>'.$r->listening.'</td>
            <td style=min-width:50px>'.$r->reading.'</td>
            <td style=min-width:50px>'.($r->listening + $r->reading).'</td>
            </tr>';
        }
        $this->html.='</table></body>
        </html>';
        return $this->html;
    }

}
?>
    
