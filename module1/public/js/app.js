$(document).ready(function(){

	(function(){
		var $contacts=$('.contacts'), $flyContainer=$('.fly-c'), initialized=false;

		$contacts.find('button.add').on('click',function(e){
			e.preventDefault();
			var $target=$(e.currentTarget), self=this;
			$.ajax({
					url : 'ajax/getcontacts.php',
					type : 'GET',
					data : {
						contact_list_id : $contacts.find('select').val()
					}
				})
				.done(function(contacts){
					contacts=JSON.parse(contacts);
					for(var i=0;i<contacts.length;i++)
						$contacts.find('tbody').append(getContactItem(contacts[i]));
					initializeListeners();
				});
		});

		function getContactItem(contact){
			var res='<tr>';
			res+='<td><input type="checkbox" name="contacts[]" checked value="'+contact.email+'"></td>';
			res+='<td><label>'+contact.email+'</label></td>';
			res+='<td><span>'+contact.name+'</span></td>';
			res+='<td><span class="remove"> x </span></td>';
			res+='</tr>';
			return res;
		}

		$contacts.find('.add-fly').on('click',function(e){
			var $target=$(e.currentTarget);
			var contact={
				name: 'enter name',
				email : 'example@mail.ru'
			};
			var newRow=getContactItem(contact);
			$contacts.find('tbody').append(newRow);
			initializeListeners();
		});

		function initializeListeners(){
			if(!initialized){
				$contacts.find('span.remove').off('click').on('click',function(e){
					var $target=$(e.currentTarget);
					$target.closest('tr').remove();
				});

				$contacts.find('tbody > tr  label').off('click').on('click',function(e){
					$(this).attr('contenteditable',true);
				});

				$contacts.find('tbody > tr  label').off('blur').on('blur',function(e){
					$(this).attr('contenteditable',false);
					$(this).closest('tr').find('input').val($(this).html());
				});
			}else{
				initialized=true;
			}
		}
	})();

	(function(){
		var $table=$('table');

		$table.find('a.remove').on('click',function(e){
			e.preventDefault();
			var $target=$(e.currentTarget);
			$.ajax({
				url : $target.attr('href'),
				type : 'GET'
			})
			.done(function(data){
				if(data){
					data=JSON.parse(data);
					if(!data.error){
						$target.closest('tr').remove();
					}else{	
						alert('не удалось');
					}
				}else{
					$target.closest('tr').remove();
				}
			});
		});
	})();
});