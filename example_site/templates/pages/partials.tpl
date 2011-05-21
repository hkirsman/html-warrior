@title = "Partial templates"

<div class="post-40 post type-post status-publish format-standard hentry category-maaratlemata" id="post-40">
  <h1 class="entry-title">Partial templates</h1>

  <div class="entry-content">

    <p>I'm text.tpl and i'm here to introduce partials. Partials are in templates/partials folder.
    One calls partial with <strong>{literal}{partial tpl="TEMPLATE_NAME_WITHOUT_EXTENSION"}{/literal}</strong>.
    This is the bare minimum - you can ofcourse add more parameters. Lets take img partial for example (using 3 of them in this template).
    The first image is defined like this: <strong>{literal}{partial tpl="img" src="data/fern-thumbnail.jpg" align="right"}{/literal}</strong>. Notice there isn't
    width or height but the output is this:<br />
    &lt;img src="images/data/fern-thumbnail.jpg" alt="" title="" width="230" height="48" style="float: right" /&gt;
    </p>

    <p>That's it for this page. Rest of the text just for fun.</p>

    <p>Far far away, <b>behind the word mountains</b>, far from the countries Vokalia and Consonantia, there live the <strong>blind texts</strong>. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small <i>river named Duden flows</i> by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

    {partial tpl="img" src="data/fern-thumbnail.jpg" align="right"}

    <p>Even the all-powerful <em><strong>Pointing</strong></em> has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad <a href="http://en.wikipedia.org/wiki/Comma" target="_blank">Commas</a>, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>

    <p>She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>

    <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>

    <p>But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>

    {partial tpl="img" src="data/path-thumbnail.jpg" align="center"}

    <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

    {partial tpl="img" src="data/inkwell-thumbnail.jpg"}

    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>

    <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the</p>

    List of random words:
    <ul>
      <li>warned</li>
      <li>country</li>
      <li>paradisematic</li>
      <li>rewritten</li>
      <li>dragged</li>
    </ul>

    <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the</p>

    List of random words:
    <ol>
      <li>warned</li>
      <li>country</li>
      <li>paradisematic</li>
      <li>rewritten</li>
      <li>dragged</li>
    </ol>

    <p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the</p>

    </div><!-- .entry-content -->
</div>