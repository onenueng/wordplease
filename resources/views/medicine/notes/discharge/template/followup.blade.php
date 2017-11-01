<div class="collapse in">
    <div class="well clearfix">
        <div class="col-xs-12"><div class="form-group">นัด Follow up</div></div>
        <div class="col-sm-2">
            <div class="form-group">
                <select id="select-xyx" class="selectpicker" name="fu_clinic" data-width="100%">
                    <option value=" ">เลือก clinic</option>
                    <option value="นัด OPD 200">OPD 200</option>
                    <option value="นัด คลินิคพิเศษ">คลินิคพิเศษ</option>
                    <option value="นัด xxxx">อื่นๆ</option>
                </select>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <select class="selectpicker" name="fu_period" data-width="100%">
                    <option value=" ">เลือก เวลา</option>
                    <option value="F/U xxxx สัปดาห์">F/U ...สัปดาห์</option>
                    <option value="F/U xxxx เดือน">F/U ...เดือน</option>
                    <option value="F/U วันที xxxx">F/U วันที่ ...</option>
                </select>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <select class="selectpicker" name="fu_doctor" data-width="100%">
                    <option value=" ">พบ แพทย์...</option>
                    <option value="พบ พ.ญ. ทดสอบ อายุรศาสตร์">ตนเอง</option>
                    <option value="พบแพทย์ xxxx">แพทย์ ....</option>
                </select>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <select class="selectpicker" name="fu_patho" data-width="100%">
                    <option value=" ">เลือก ฟังผล patho</option>
                    <option value="ฟังผล patho">นัดฟังผล patho</option>
                    <option value=" ">ไม่นัดฟังผล patho</option>
                </select>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
            <select name="fu_lab" class="selectpicker" data-width="100%" data-none-selected-text="เลือกสิ่งส่งตรวจ" multiple>
                <option>CBC</option>
                <option>U/A</option>
                <option>UPCR</option>
                <option>FBS</option>
                <option>Cr</option>
                <option>Na</option>
                <option>K</option>
                <option>HCO&#x2083;</option>
                <option>Ca</option>
                <option>PO&#x2084;</option>
                <option>AST</option>
                <option>ALT</option>
                <option>Albumin</option>
                <option>PT, PTT, INR</option>
                <option>Uric acid</option>
                <option>CXR</option>
                <option>EKG</option>
                <option>อื่นๆ พิมพ์เพิ่มเอง</option>
            </select>
            </div>
        </div>

        <button type="button" class="btn btn-info" onclick="followupInputHelper('follow_up');">Put</button>

        <div class="col-xs-12"><hr/></div>

        <div class="col-xs-12"><div class="form-group">นัด Admit</div></div>

        <div class="col-sm-4 col-xs-12">
            <div class="form-group">
                <select name="admit_lab" class="selectpicker" data-none-selected-text="เลือกสิ่งส่งตรวจ" multiple>
                    <option>CBC</option>
                    <option>U/A</option>
                    <option>UPCR</option>
                    <option>FBS</option>
                    <option>Cr</option>
                    <option>Na</option>
                    <option>K</option>
                    <option>HCO&#x2083;</option>
                    <option>Ca</option>
                    <option>PO&#x2084;</option>
                    <option>AST</option>
                    <option>ALT</option>
                    <option>Albumin</option>
                    <option>PT, PTT, INR</option>
                    <option>Uric acid</option>
                    <option>CXR</option>
                    <option>EKG</option>
                    <option>อื่นๆ พิมพ์เพิ่มเอง</option>
                </select>
                <button type="button" class="btn btn-info" onclick="admitInputHelper('follow_up');">Put</button>
            </div>
        </div>
        <div class="col-xs-12"><hr/></div>

        <div class="col-xs-12"><div class="form-group">นัด Imaging</div></div>

        <div class="col-sm-4 col-xs-12">
            <div class="form-group">
                <select name="fu_imaging" class="selectpicker" data-none-selected-text="เลือก imaging" data-multiple-separator=" " multiple>
                    <optgroup label="CT">
                        <option value="CT chest">chest</option>
                        <option value="CT abdomen">abdomen</option>
                        <option value="CT brain">brain</option>
                        <option value="CT xxxx">อื่นๆ</option>
                    </optgroup>
                    <optgroup label="MRI">
                        <option value="MRI brain">brain</option>
                        <option value="MRI xxxx">อื่นๆ</option>
                    </optgroup>
                    <optgroup label="MRA">
                        <option value="MRA brain">brain</option>
                        <option value="MRA xxxx">อื่นๆ</option>
                    </optgroup>
                    <optgroup label="">
                        <option value="CXR">CXR</option>
                    </optgroup>
                </select>
                <button type="button" class="btn btn-info" onclick="imagingInputHelper('follow_up');">Put</button>
            </div>
        </div>
        <div class="col-xs-12"><hr/></div>

        <div class="col-sm-4 col-xs-12">
            <div class="form-group">
                <button type="button" class="btn btn-info" onclick="followupInputHelperFinishing('Refer ไป รพ. xxxx','follow_up');">Refer</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.selectpicker').selectpicker({size: 5});
    function followupInputHelper(inputTarget) {
        var str;
        str = $("select[name=fu_clinic]").val() + ' ';
        str += $("select[name=fu_period]").val() + ' ';
        str += $("select[name=fu_doctor]").val() + ' ';
        str += $("select[name=fu_patho]").val() + ' ';
        str += $("select[name=fu_lab]").val() === null ? '' : 'สิ่งส่งตรวจ ' + $("select[name=fu_lab]").val();
        followupInputHelperFinishing(str, inputTarget);
        // return str;
    }
    function admitInputHelper(inputTarget) {
        var str = "นัด admit วันที่ xxxx อาจารย์ xxxx เพื่อ xxxx ";
        str += $("select[name=admit_lab]").val() === null ? '' : 'สิ่งส่งตรวจ ' + $("select[name=admit_lab]").val();
        followupInputHelperFinishing(str, inputTarget);
    }
    function imagingInputHelper(inputTarget) {
        var str = "นัด imaging ";
        str += $("select[name=fu_imaging]").val() === null ? '' : $("select[name=fu_imaging]").val() + ' วันที่ xxxx';
        followupInputHelperFinishing(str, inputTarget);
    }
    // function referInputHelper(inputTarget) {
    //     followupInputHelperFinishing("Refer ไป รพ. xxxx", inputTarget);
    // }
    function followupInputHelperFinishing(str, inputTarget) {
        var oldValue = $("textarea[name=" + inputTarget + "]").val();
        var newValue = oldValue === '' ? str : oldValue + "\n" + str;
        $("textarea[name=" + inputTarget + "]").val(newValue);
        autosize.update($('textarea[name=' + inputTarget + ']'));
    }
</script>