<h1>Style Guide</h1>

<h2>Headings</h2>
<dl>
  <dt>h1</dt><dd>Title</dd>
  <dt>h2</dt><dd>Sections</dd>
  <dt>h3</dt><dd>Listings within sections</dd>
</dl>

<h2>Text</h2>
<ul>
  <li><strong>Strong.</strong></li>
  <li><i>Emphasis</i></li>
</ul>

<h2>Horizontal Rule</h2>
<p>Centers and draws the logo as divider</p>
<hr/>

<h2>Lists</h2>
<p>Unordered list</p>
<p>Ordered list</p>
<p>Definition list</p>

<h2>Images</h2>
<p>Images should have a 1.92 aspect ratio</p>

## Notes

### Vertical Rhythms

* http://surgeworks.com/blog/responsive-web-design-using-compass-pt2
* http://24ways.org/2006/compose-to-a-vertical-rhythm

## Vagrant & Chef

* Install VirtualBox extensions to avoid missing USB controller errors.
* Do not clone the entire cookbooks directory, only grab what you need.
  Otherwise, chef will attempt to read other cookbooks as well.
* add `apt` cookbook - does an apt update so it can install packages
* `mysql` cookbook - set `mysql_password`. otherwise it is reset each time
* 