@layout = empty
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Lastepoe uudiskiri</title>
{if $page=="newsletter_web"}
    {partial tpl="script" file="externals/jquery-1.4.4.min" indent="    "}
    {partial tpl="script" file="newsletter" indent="    "}
{literal}
    <style type="text/css">
      .form{color:#404040;border-left:1px solid #000;border-right:1px solid #000;overflow:hidden;padding:10px 20px;}
      .form .header{font-size:18px;border-bottom:1px solid #C4C4C4;padding:6px 4px;line-height:22px;}
      .form .content{padding-top:19px;padding-bottom:50px;}
      .frmrow{margin:7px 0 7px 23px;}
      .frmcaption{color:#808080;display:block;font-weight:bold;padding-bottom:4px;padding-left:10px;}
      .textinput01{display:inline-block;margin-left:57px;}
      .textinput01 .input{background:url("images/base/textinput.gif");border:1px solid #BBBBBB;display:block;}
      .textinput01 .input input{background:url("images/1x1.png");border:0;display:block;font-size:11px;font-weight:normal;height:13px;line-height:13px;margin:0 !important;padding:8px 10px 7px;vertical-align:middle;width:278px;}
      .error .textinput01 .input{background-image:url("images/base/textinputError.gif");border-color:#A53C35;}
      button{width:auto;overflow:visible !important}
      button::-moz-focus-inner{border:none;padding:0;}
      .button1{background:url("images/newsletter/button.gif") 100% 0;float:right;height:31px;padding:0 13px 0 0;border:0;line-height:14px;cursor:pointer;}
      .safari button span{margin:-1px -3px 0;position:relative;}
      .button1 span{background:url("images/newsletter/button.gif");display:block;padding:7px 0 10px 13px;color:#FFFFFF;font-family:Verdana, sans-serif;font-size:12px;min-width:65px;}
      .buttons{padding-top:1px;width:381px;}
      a{color:#00AEFF;text-decoration:underline;}
      a:hover{text-decoration:underline !important;}
      .msgSuccess{background:#CDF49B;color:#669A22;line-height:12px;margin:20px 0;padding:7px 10px 8px;}
      .msgError{background:#FFCDCA;color:#A73D36;line-height:12px;margin:20px 0;padding:7px 10px 8px;}
      .chooser,.chooser02{display:block;margin-left:57px;}
      .chooser .inputs,.chooser02 .inputs{display:inline-block;padding-left:3px;vertical-align:middle;width:290px;}
      .chooser .inputs .option,.chooser02 .inputs .option{display:inline-block;padding-bottom:4px;padding-right:10px;padding-top:4px;}
      .chooser .inputs input,.chooser02 .inputs input{display:inline-block;height:13px;margin:0 5px 0 0;padding:0;vertical-align:middle;width:13px;}
      .chooser .inputs .icaption,.chooser02 .inputs .icaption{line-height:12px;vertical-align:middle;}
      .chooser .inputs .optionCaption,.chooser02 .inputs .optionCaption{display:inline-block;padding:0 0 0 7px;vertical-align:middle;}
    </style>
{/literal}
{/if}
  </head>
  <body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#433650" style="background-color:#433650;">
    <div align="center" style="background-color:#433650;">
      <div style="background: white; padding: 5px 0 9px 0;">
        <a href="javascript:void(0)" style="font-family: Verdana, sans-serif; font-size: 10px; text-decoration: underline; color: #404040; line-height:16px; ">Klikkige siia, kui te ei näe uudiskirja korralikult</a>
      </div>
      <table width="502" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>{partial tpl="img" file="newsletter/head_ee.jpg" link="newsletter.html" alt="lastepood.ee" border=0 style="display:block" indent=""}</td><!--Head-->
        </tr>
        <tr>
          <td align="left" style="font-family: Verdana, sans-serif; font-size: 11px; line-height: 20px; color: #404040; background: white;">          
            
            <div style="border-left: 1px solid #000; border-right: 1px solid #000;padding-right: 23px; padding-left: 23px; padding-bottom: 20px; overflow: hidden; ">
              <p style="color: #03A2EE;font-size: 18px;line-height: 22px;margin: 13px 0;padding: 0;">Praesent ultricies bibendum leo nec facilisis</p>
            
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et elit a sapien viverra mattis vitae sit amet augue. Sed urna mauris, commodo et dictum dapibus, eleifend id est. Integer velit diam, elementum nec porttitor sed, consectetur sed elit. Suspendisse feugiat pellentesque volutpat.</p>

              <p>Aenean sed massa odio. Donec nec sem suscipit velit tincidunt egestas. In id tellus eget arcu venenatis semper. Etiam sapien risus, feugiat vulputate pulvinar vel, imperdiet eu augue. Quisque commodo malesuada arcu, quis euismod velit blandit sit amet.</p>

              <p>Nulla bibendum euismod ligula, <a href="javascript:void(0)">eget volutpat</a> dui malesuada sed. Cras pharetra, justo ac aliquet mollis, mi purus condimentum nibh, id gravida dolor augue a massa. Nam non nisi velit, eu ultrices felis. Maecenas metus ipsum, vehicula in interdum vel, pulvinar quis metus. Duis metus ante, pulvinar sed fermentum at, posuere ut eros. Aliquam erat volutpat.</p>

              <p>Vestibulum non congue risus. Maecenas nec iaculis nisl. In adipiscing quam convallis augue pellentesque adipiscing. Etiam bibendum dolor ut ipsum congue nec sodales massa pharetra. Nulla nec felis eget lorem tincidunt porta sed id justo. Nulla nisi libero, placerat vel laoreet at, elementum non odio. Fusce ut diam nibh, vitae porttitor lorem.</p>

              <p>Etiam vestibulum rhoncus massa sit amet luctus. Sed tincidunt tortor at nisi dignissim quis ornare elit bibendum. Etiam a nunc vel ligula luctus porta id eu ligula. Cras ac fermentum justo. Curabitur lobortis, metus nec egestas luctus, nunc tellus scelerisque justo, vel volutpat quam augue sed magna. Cras ac fermentum justo. Proin pulvinar rutrum quam, sed posuere dolor volutpat mattis. Phasellus tincidunt eleifend est, in venenatis felis volutpat eget. Phasellus nec egestas enim. Curabitur lobortis, metus nec egestas luctus, nunc tellus scelerisque justo, vel volutpat quam augue sed magna. Cras ac fermentum justo.</p>

              <p>Proin pulvinar rutrum quam, sed posuere dolor volutpat mattis. Phasellus tincidunt eleifend est, in venenatis felis volutpat eget. </p>
            </div>

{if $page=="newsletter"}
            <div style="border-left: 1px solid #000000;border-right: 1px solid #000000;padding: 30px 0;text-align: center;">
              <a href="newsletter_web.html#form" style="display: inline-block;text-decoration:none"><img src="images/newsletter/sendtofriends_ee.gif" alt="" border="0" /></a>
              <!--<a href="newsletter_web.html#form" style="background:url('images/newsletter/button.gif') 100% 0;border: 0;color:white;cursor:pointer;display: inline-block;font-family:Verdana,sans-serif;font-size: 12px;height:31px;line-height:14px;margin: 0;padding:0 13px 0 0;text-decoration:none"><span style='background:url("images/newsletter/button.gif");display:block;min-width: 355px;padding:7px 0 10px 13px;'>Klikkige siia, et saata uudiskiri sõpradele edasi</span></a>-->
            </div>            
{else}
            <div class="form">
              <a name="form"></a>
              <div class="header">
                Saada uudiskiri sõpradele edasi
              </div>
              <div class="content">
                <div class="msgSuccess">
                  <b>Andete muutmine õnnestus!</b> Võite jätkata.
                </div>
                <div class="msgError">
                  <b>Andete muutmine ebaõnnestus!</b> Palun kontrollige üle märgistatud väljad.
                </div>

                {partial template="textinput" class="textinput01" error=1 caption="Sõprade e-maili aadressid:" mandatory=false indent="                "}
                {partial template="textinput" class="textinput01" caption="" mandatory=false indent="                "}
                {partial template="textinput" class="textinput01" caption="" mandatory=false indent="                "}
                {partial template="textinput" class="textinput01" caption="" mandatory=false indent="                "}
                {partial template="textinput" class="textinput01" caption="" mandatory=false indent="                "}
                <div class="frmrow"><span><span class="chooser02"><span class="frmcaption">Soovin pakkumisi:</span><span class="inputs">  <label class="option"><input type="checkbox" name="" class="input"><span class="icaption">E-maili teel</span></label></span></span></span></div>
                <div class="buttons">
                  {partial tpl="button" class="button1" label_caption="Saada" indent="                  "}
                </div>
              </div>
            </div>
{/if}

            <div style="text-align: center;border-left: 1px solid #000; border-right: 1px solid #000; ">
              <div style="border-top: 1px solid #C4C4C4; border-top: 1px solid #C4C4C4; padding-top: 3px; padding-bottom: 1px;">
                <a href="javascript:void(0)" style="font-family: Verdana, sans-serif; font-size: 10px; text-decoration: none; color: #404040; ">Klikkige siia kui te ei soovi saada rohkem uudiskirju ›</a>
              </div>
            </div>
            
          </td>
        </tr>
        <tr>
          <td style="padding-bottom: 20px;">
            <table id="Table_01" width="502" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td><img id="footerTl" src="images/newsletter/footerTl.gif" width="6" height="8" alt="" style="display:block" /></td>
                  <td><img id="footerTm" src="images/newsletter/footerTm.gif" width="490" height="8" alt="" style="display:block" /></td>
                  <td><img id="footerTr" src="images/newsletter/footerTr.gif" width="6" height="8" alt="" style="display:block" /></td>
                </tr>
                <tr>
                  <td><img id="footerMl" src="images/newsletter/footerMl.gif" width="6" height="42" alt="" style="display:block" /></td>
                  <td width="490" height="42" bgcolor="#211A28" style="font-family: Verdana, sans-serif; font-size: 10px; color: white;">
                    <div style="line-height:42px; height: 42px; float: left; padding-left: 20px; font-weight:bold;">
                        Lastepood.ee
                    </div> 
                    <div style="line-height:42px; height: 42px;text-align: right; color: #D0C5DB;float: right; padding-right: 20px;">
                      <a href="mailto:info@lastepood.ee" style="color: #D0C5DB; text-decoration:none;">info@lastepood.ee</a> | Tel. 6 032 470
                    </div>
                  </td>
                  <td><img id="footerMr" src="images/newsletter/footerMr.gif" width="6" height="42" alt="" style="display:block" /></td></tr>
                <tr>
                  <td><img id="footerBl" src="images/newsletter/footerBl.gif" width="6" height="6" alt="" style="display:block" /></td>
                  <td><img id="footerBm" src="images/newsletter/footerBm.gif" width="490" height="6" alt="" style="display:block" /></td>
                  <td><img id="footerBr" src="images/newsletter/footerBr.gif" width="6" height="6" alt="" style="display:block" /></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
