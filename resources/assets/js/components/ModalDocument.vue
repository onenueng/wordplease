<template>
    <div class="modal fade" id="modal-child-pugh-score" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-default" id="modal-sms-box-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p class="modal-title"><span class="fa fa-comment-o" aria-hidden="true"></span> Child-Pugh's Score</p>
                </div>
                
                <div class="modal-body" id="modal-body-child-pugh" style="max-height: calc(100vh - 30vh); overflow-y: auto;">
                    <p>The score employs five clinical measures of liver disease. Each measure is scored 1-3, with 3 indicating most severe derangement.</p>
                    <table cellpadding="3" cellspacing="0" border="1" style="border-collapse:collapse">
                        <tr style="background-color:#aad">
                            <th class="text-center" style="width: 20%;">Measure</th>
                            <th class="text-center" style="width: 10%;">1 point</th>
                            <th class="text-center" style="width: 35%;">2 points</th>
                            <th class="text-center" style="width: 35%;">3 points</th>
                        </tr>
                        <tr>
                            <td>Total bilirubin (mg/dl)</td>
                            <td>&lt;2</td>
                            <td>2-3</td>
                            <td>&gt;3</td>
                        </tr>
                        <tr>
                            <td>Serum albumin (g/dl)</td>
                            <td>&gt;3.5</td>
                            <td>2.8-3.5</td>
                            <td>&lt;2.8</td>
                        </tr>
                        <tr>
                            <td>Prothrombin time (secs)</td>
                            <td>&lt;4.0</td>
                            <td>4.0-6.0</td>
                            <td>&gt; 6.0</td>
                        </tr>
                        <tr>
                            <td>Ascites</td>
                            <td>None</td>
                            <td>Mild</td>
                            <td>Moderate to Severe</td>
                        </tr>
                        <tr>
                            <td>Hepatic encephalopathy</td>
                            <td>None</td>
                            <td>Grade I-II (or suppressed with medication)</td>
                            <td>Grade III-IV (or refractory)</td>
                        </tr>
                    </table>
                    <p>Different textbooks and publications use different measures. Some older reference works substitute PT prolongation for INR.</p>
                    <p>In <a  title="Primary sclerosing cholangitis">primary sclerosing cholangitis</a> (PSC) and <a  title="Primary biliary cirrhosis">primary biliary cirrhosis</a> (PBC), the bilirubin references are changed to reflect the fact that these diseases feature high conjugated bilirubin levels. The upper limit for 1 point is 4&#160;mg/dl and the upper limit for 2 points is 10&#160;mg/dl.</p>
                    <table cellpadding="3" cellspacing="0" border="1" style="border-collapse:collapse">
                        <tr>
                        <td bgcolor="#AAAADD"><b>Points</b></td>
                        <td bgcolor="#AAAADD"><b>Class</b></td>
                        <td bgcolor="#AAAADD"><b>One year survival</b></td>
                        <td bgcolor="#AAAADD"><b>Two year survival</b></td>
                        </tr>
                        <tr>
                        <td>5-6</td>
                        <td>A</td>
                        <td>100%</td>
                        <td>85%</td>
                        </tr>
                        <tr>
                        <td>7-9</td>
                        <td>B</td>
                        <td>81%</td>
                        <td>57%</td>
                        </tr>
                        <tr>
                        <td>10-15</td>
                        <td>C</td>
                        <td>45%</td>
                        <td>35%</td>
                        </tr>
                    </table>
                    <p>Chronic liver disease is classified into Child-Pugh class A to C, employing the added score from above.</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" id="modal-sms-box-btn" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style type="text/css">
    #modal-body-child-pugh {
        font-size: 12pt;
    }
    #modal-body-child-pugh td {
        padding-left: 5px;
    }
    #modal-body-child-pugh p {
        padding-top: 5px;
    }
</style>

