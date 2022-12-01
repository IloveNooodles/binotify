<?php

function return_html($data = []){
// $all_user = users_in_html($data);
$html = <<<"EOT"
	<body>
	<table id="premiumArtistList">
		<tr class="row-title">
			<th>#</th>
			<th>PREMIUM ARTIST</th>
			<th>SUBSCRIPTION</th>
		</tr>
	</table>
	</body>
EOT;
echo $html;
}

function users_in_html($data){
$html = <<<"EOT"
	<tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="12">Rejected</button>
		</td>
	</tr>
	<tr class="content">
		<td>2</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>   
		<td>
			<a href="/subscribed/1">
				<button class="btn-val subscribe" value="13">Rejected</button>
			</a>
		</td>   
	</tr>
	<tr class="content">
		<td>3</td>
		<td>
			<p class="artist-name">Roman Sombong Asu</p>
		</td>   
		<td>
			<button class="btn-val subscribe" value="0">Rejected</button>
		</td>   
	</tr>
		<tr class="content">
		<td>4</td>
		<td>
			<p class="artist-name">Roman Sombong Asu</p>
		</td>   
		<td>
			<button class="btn-val subscribe" value="111">Pending...</button>
		</td>   
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="111">Subscribe</button>
		</td>
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="4">Subscribe</button>
		</td>
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="5">Subscribe</button>
		</td>
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="6">Subscribe</button>
		</td>
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="7">Subscribe</button>
		</td>
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="btn-val subscribe" value="8">Subscribe</button>
		</td>
	</tr>
EOT;
return $html;
}

return_html($data);