{partial tpl="msgError"}

<form class="frm" action="">
  <div class="fieldset">
    <div class="legend">Ettevõtte kirjeldus</div>
        {partial tpl="forminput" rowclass="frmrow" type="text" label_caption="Your name:"}
        {partial tpl="forminput" rowclass="frmrow" type="text" label_caption="Your e-mail:" error=1}
        {partial tpl="forminput" rowclass="frmrow" type="text" label_caption="Your phone:"}
        {partial tpl="forminput" rowclass="frmrow" type="textarea" label_caption="Message:"}
        {partial tpl="forminput" rowclass="frmrow" type="textarea" label_caption="Message:" error=1}
        {partial tpl="forminput" rowclass="frmrow" type="check_one" values=array("Male", "Female") label_caption="Gender:"}
        {partial tpl="forminput" rowclass="frmrow" type="check_one" values=array("Male", "Female") label_caption="Gender:" error=1}
        {partial tpl="forminput" rowclass="frmrow" type="check_many" values=array("Cycling", "Swimming", "Running") label_caption="Hobbies:"}
        {partial tpl="forminput" rowclass="frmrow" type="check_many" values=array("Cycling", "Swimming", "Running") label_caption="Hobbies:" error=1}
        {partial tpl="forminput" rowclass="frmrow" type="select" values=array("Choose", "England", "Estonia", "Finland", "Sweden") label_caption="Country:"}
        {partial tpl="forminput" rowclass="frmrow" type="select" values=array("Choose", "England", "Estonia", "Finland", "Sweden") label_caption="Country:" error=1}
        {partial tpl="forminput" rowclass="frmrow" type="multiselect" values=array("Choose", "England", "Estonia", "Finland", "Sweden") label_caption="Country:"}
        {partial tpl="forminput" rowclass="frmrow" type="multiselect" values=array("Choose", "England", "Estonia", "Finland", "Sweden") label_caption="Country:" error=1}
  </div>
</form>