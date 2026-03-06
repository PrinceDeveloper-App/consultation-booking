<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php if(isset($pagename)){ echo $pagename; } ?></h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li class="active"><?php if(isset($breadcrumb)){ echo $breadcrumb; } ?></li>
						<?php if(isset($breadcrumb_sub)){ ?>
                        <li class="active"><?php  echo $breadcrumb_sub; ?></li>
						<?php } ?>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>