<script type="text/javascript">

$(function(){
    $(".popup_carts").load("<?php echo base_url();?>user/shop/info");
});

function addtocart(id) {

	var quatity = $('.quantity').val();
	if(quatity) {
		var qty = quatity;
	} else {
		var qty = '1';
	}
  	$.ajax({
		url: '<?php echo base_url();?>user/shop/addcart',
		type: 'post',
		data: {'ProductId':id, 'qty':qty},
		
		dataType: 'json',
		beforeSend: function() {
			$('#button-coupo1n').button('loading');
		},
		complete: function() {
			$('#button-coupo1n').button('reset');
		},
		success: function(json) {


			if(json['success']) {

				$('.cart_item_count').html('cart('+json['totalitems']+')');
				$(".popup_carts").load("<?php echo base_url();?>user/shop/info");

				$('.flashmessage').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['success'] + '</div>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}

			if (json['error']) {
				$('.flashmessage').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
			// $('html, body').animate({ scrollTop: 0 }, 'slow');
			
		}
	});

}

function wishlist(id) {
	$.ajax({
		url: '<?php echo base_url();?>user/shop/wishlist',
		type: 'post',
		data: 'ProductId=' + id,
		dataType: 'json',
		success: function(json) {
			$('.alert').remove();

			if (json['success']) {
				$('#fav_product_'+json['id']+' i').removeClass('fa-heart-o');
				$('#fav_product_'+json['id']+' i').addClass('fa-heart text-danger');
				// $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			if (json['fail']) { 
				url = "<?php echo base_url();?>login";
      			$( location ).attr("href", url);
				// window.location.href('/login');
				// $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> ' + json['fail'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
}

function unwishlist(id) {
	$.ajax({
		url: '<?php echo base_url();?>user/shop/removewishlist',
		type: 'post',
		data: 'ProductId=' + id,
		dataType: 'json',
		success: function(json) {
			$('.alert').remove();

			if (json['success']) {
				$('#fav_product_'+json['id']+' i').removeClass('fa-heart text-danger');
				$('#fav_product_'+json['id']+' i').addClass('fa-heart-o');
				$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			if (json['fail']) { 
				$('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> ' + json['fail'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
}

function removeCart(rowid){
	$.ajax({
        type: 'post',
        url : '<?php echo base_url();?>user/shop/removecart',
        data : {'rowid':rowid},
        dataType: 'json',
        success : function(json)
        {
        	if(json['success']) {
        		$(".popup_carts").load("<?php echo base_url();?>user/shop/info");
        		$('.cart_item_count').html('cart('+json['totalitems']+')');
				$('.flashmessage').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['success'] + '</div>');
        	}
        	if (json['error']) {
        		$(".popup_carts").load("<?php echo base_url();?>user/shop/info");
				$('.flashmessage').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');
			}

        }

	})
}

function RemoveCart(rowid){
	$.ajax({
        type: 'post',
        url : '<?php echo base_url();?>user/shop/removecart',
        data : {'rowid':rowid},
        dataType: 'json',
        success : function(json)
        {
        	if(json['success']) {
				$('.flashmessage').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['success'] + '</div>');
				window.location.href='<?php echo base_url();?>user/viewcart';
        	}
        	if (json['error']) {
        		$(".popup_carts").load("<?php echo base_url();?>user/shop/info");
				$('.flashmessage').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');
			}

        }

	})
}

function viewcart(){
	window.location.href='<?php echo base_url();?>user/viewcart';
}

function checkout(){
	window.location.href='<?php echo base_url();?>user/checkout';
}

function SubscribeFunc() {
	if($('#subscmail').val()!==''){
		$.ajax({
	        type: 'post',
	        url : '<?php echo base_url();?>user/user/subscribe',
	        data : {'mailid':$('#subscmail').val(),'ref': '<?php echo  $this->input->get('ref');?>'},
	        dataType: 'json',
	        success : function(json)
	        {
	        	if(json['success']) {
					$('.flashmessage_footer').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['success'] + '</div>');
					$('#subscmail').empty();
	        	}
	        	if (json['error']) {
					$('.flashmessage_footer').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');
				}
	        }
		})
	} else {
		$('.flashmessage_footer').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Email-ID is Required</div>');
	}
}
</script>