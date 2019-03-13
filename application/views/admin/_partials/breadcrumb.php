<!-- Breadcrumbs-->
<ol class="breadcrumb">
<?php //echo $i = count($this->uri->segments); ?>
<?php foreach ($this->uri->segments as $segment): ?>
	<?php if(!is_numeric($segment)){ ?>
	<?php 
		$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
		$is_active =  $url == $this->uri->uri_string;
	?>


	<li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?>">
		<?php if($is_active && !is_numeric($segment)): ?>
			<?php echo ucfirst($segment) ?>
		<?php elseif(!is_numeric($segment)): ?>
			
			<a href="<?php echo site_url($url) ?>"><?php echo ucfirst($segment) ?></a>
		<?php endif; ?>
	</li>
	<?php } ?>
<?php endforeach; ?>
</ol>
