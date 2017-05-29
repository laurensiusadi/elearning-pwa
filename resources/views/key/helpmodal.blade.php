<div id="modalhelp" class="modal">
    <div class="modal-content">
        <h4>ExceptJS</h4>
        <h5>exist</h5>
        <code>$expect('div').to.exist();</code>
        <h5>items / elements / length</h5>
        <code>$expect('ol > li').to.have.items(4);</code>
        <h5>above / greaterThan</h5>
        <code>$expect('li').to.be.above(4);</code>
        <h5>below / lessThan</h5>
        <code>$expect('li').to.be.lessThan(5);</code>
        <h5>be / a / an</h5>
        <code>$expect('div').to.be('.widget');
        $expect('input').to.be('[type=text]');
        $expect('.win').to.be.a('div');
        $expect('.list').to.be.an('ol');</code>
        <h5>eql / equal</h5>
        <code>$expect('li.first').to.be.equal('li:first');
        $expect('div').to.be.equal($('.all-the-divs'));</code>
        <h5>attr</h5>
        <code>$expect('.container').to.have.attr('id', 'content');
        $expect('.some-input').to.have.attr('value');</code>
        <h5>text</h5>
        <code>$expect('.link-1').to.have.text(10);
        $expect('.link-1').to.have.text(/code/i);
        $expect('.link-1').to.have.text('Codecademy');
        $expect('.link-2').to.have.text('Google', 'Why not?');</code>
        <h5>match</h5>
        <code>$expect('.link-1').to.match(/code/i);</code>
        <h5>contain</h5>
        <code>$expect('body').to.contain('author');
        $expect('.links').to.contain('people');
        $expect('.content').to.contain('Amjad', 'My name must exist and be capitalized');</code>
        <div class="modal-footer">
            <button type="button" class="modal-close btn btn-flat right">Close</button>
        </div>
    </div>
</div>
