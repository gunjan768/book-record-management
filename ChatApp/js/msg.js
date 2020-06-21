$(document).ready(function()
{
	$('#submit').click(function()
	{
		
		$('#error').css('display','none');

		$.ajax(
		{
			url: "msg.php" ,
			type: 'POST',
			data: $("#myform input").serialize(),
			// data: $("#myform input").serialize(),
			// serialize() gives input name in serial order

			success: function(result)  // result will come as response in variable 'result'
			{   
				if(result)
				{
					$('#error').html(result);
					$('#error').css('display','block');
				}
			}
		})
		clearInput();
	})

	$('#myform').submit(function()
	{
		return false;
	})

	function clearInput()
	{
		$('#msg_content').val("");
	}
})