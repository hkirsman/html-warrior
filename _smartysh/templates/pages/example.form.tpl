@title = "Isiklike andmete muutmine"

<div class="shortProfile">
  <ul class="personalDataA">
    <li><span class="caption">Kaardi number:</span><span class="val">2938-2859-7463-2958</span></li>
    <li><span class="caption">Ees- ja perekonnanimi:</span><span class="val">Juhan Juhanipoeg</span></li>
    <li><span class="caption">Sünniaeg:</span><span class="val">01/01/1971</span></li>
    <li><span class="caption">Sugu:</span><span class="val">Mees</span></li>
  </ul>

  <div class="imageUpload">
    <div class="image"><img src="images/data/profile.jpg" alt="" width="100" height="100" /></div>
    <div class="upload">
      <p class="title">Sinu foto</p>
      Lae oma arvutist enda foto. Maksimaalne faili suurus <b>1MB.</b>
      <div>
        <input type="file" name=""/>
      </div>
    </div>
  </div>
</div><!-- .shortProfile -->


<form class="frm" action="">
  <div class="msgSuccess">
    <b>Andete muutmine õnnestus!</b> Võite jätkata.
  </div>
  <div class="msgError">
    <b>Andete muutmine ebaõnnestus!</b> Palun kontrollige üle märgistatud väljad.
  </div>

  <div class="frmnote"><div class="a"><span class="frmMandatoryMark">*</span> Tähistab kohtuslikku välja</div></div>

  <div class="clear"></div>

  <div class="col col05">
    {partial template="chooser" type="radio" values=array('abielus','vallaline') caption="Perekonnaseis:" mandatory=true indent="    "}
    {partial template="textinput" class="textinput01" error=true caption="Tänav:" mandatory=true indent="    "}
    {partial template="textinput" error=true type="range" caption="Maja, korteri nr:" mandatory=true indent="    "}
    {partial template="textinput" class="textinput01" caption="Linn/Maakond:" mandatory=true indent="    "}
    {partial template="textinput" class="textinput02" caption="Sihtnumber:" sufix='<a href="http://www.post.ee/ariklient_sihtnumbrid_allalaadimiseks" target="blank">Otsi</a>' mandatory=true indent="    "}
    {partial template="textinput" class="textinput01" caption="Riik:" mandatory=true indent="    "}
    {partial template="textinput" class="textinput03" caption="Mobiiltelefoni nr:" prefix="+372" mandatory=true indent="    "}
    {partial template="textinput" class="textinput03" caption="Muu telefoni nr:" prefix="+372" mandatory=true indent="    "}
    {partial template="textinput" class="textinput01" caption="E-posti aadress:" mandatory=true indent="    "}
    {partial template="select" caption="Haridus:" values=array('vali') indent="    "}
    {partial template="select" caption="Tegevusala:" values=array('vali') indent="    "}
    {partial template="select" caption="Sissetulek:" values=array('vali') indent="    "}
    {partial template="chooser" class="chooser02" type="checkbox" values=array('E-maili teel','SMSi teel','Tavapostiga') caption="Soovin rimi pakkumisi:" indent="    "}    
  </div>
  <div class="col col06">
    <ul class="offersOptions">
      <li class="caption">Huvi pakkuvad Rimi pakkumised:</li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Toiduained</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Joogid</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Mänguasjad</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Raamatud</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Kontorikaup</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">CD/DVD</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Aiatarbed</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Sporditarbed</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Autokaup</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Ökotooted</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Lastekaup</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Lemmikloomatooted</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Rõivad ja tekstiil</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Hooaja- ning vabaajakaup</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Majapidamistarbed</span></label></li>
      <li><label class="checkbox01"><input type="checkbox" name="" /><span class="optionCaption">Kodukeemia</span></label></li>
    </ul>
  </div>

  <div class="clear"></div>

  <div class="frmbuttons">
    {partial template="button" class="button03 rbutton" caption="Salvesta muudatused" indent="    "}
  </div>
  
</form>