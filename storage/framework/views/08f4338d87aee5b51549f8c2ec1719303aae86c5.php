<div class='form-group <?php echo e($header_group_class); ?> <?php echo e(($errors->first($name))?"has-error":""); ?>' id='form-group-<?php echo e($name); ?>' style="<?php echo e(@$form['style']); ?>">
			<label class='col-sm-2 control-label'><?php echo e($form['label']); ?> <?php echo ($required)?"<span class='text-danger' title='This field is required'>*</span>":""; ?></label>

			<div class="<?php echo e($col_width?:'col-sm-10'); ?>">
			<?php if($value): ?>
				<?php 
					$file = str_replace('uploads/','',$value);
					$is_temporary = (Request::get('temporary'))?:0;
					if(Storage::exists($file)):								
						$url         = asset($value);
						@$ext         = strtolower(end(explode('.',$value)));
						$images_type = array('jpg','png','gif','jpeg','bmp','tiff');																																				
						if(in_array($ext, $images_type)):
						?>
							<p><a class='fancybox' href='<?php echo e($url); ?>'><img style='max-width:160px' title="Image For <?php echo e($form['label']); ?>" src='<?php echo e($url); ?>'/></a></p>
						<?php else:?>
							<p><a href='<?php echo e($url); ?>'><?php echo e(trans("crudbooster.button_download_file")); ?></a></p>
						<?php endif;
							echo "<input type='hidden' name='_$name' value='$value'/>";
					else:
						echo "<p class='text-danger'><i class='fa fa-exclamation-triangle'></i> ".trans("crudbooster.file_broken")."</p>";
					endif; 
				?>
				<?php if(!$readonly || !$disabled): ?>
				<p><a class='btn btn-danger btn-delete btn-sm' onclick="if(!confirm('<?php echo e(trans("crudbooster.delete_title_confirm")); ?>')) return false" href='<?php echo e(url(CRUDBooster::mainpath("delete-image?image=".$value."&id=".$row->id."&column=".$name."&temporary=".$is_temporary))); ?>'><i class='fa fa-ban'></i> Delete </a></p>
				<?php endif; ?>
			<?php endif; ?>	
			<?php if(!$value): ?>
			<input type='file' id="<?php echo e($name); ?>" title="<?php echo e($form['label']); ?>" <?php echo e($required); ?> <?php echo e($readonly); ?> <?php echo e($disabled); ?> class='form-control' name="<?php echo e($name); ?>"/>							
			<p class='help-block'><?php echo e(@$form['help']); ?></p>
			<?php else: ?>
			<p class='text-muted'><em><?php echo e(trans("crudbooster.notice_delete_file_upload")); ?></em></p>
			<?php endif; ?>
			<div class="text-danger"><?php echo $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):""; ?></div>

			</div>
			
		</div>
<?php /**PATH /home/vagrant/code/aroka-book-store/vendor/crocodicstudio/crudbooster/src/views/default/type_components/upload/component.blade.php ENDPATH**/ ?>