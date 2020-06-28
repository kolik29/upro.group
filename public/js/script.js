let selectedFile;

$('#file').change(function (e) {
	selectedFile = event.target.files[0];
	$('label[for=' + $(this).attr('id') + ']').text(selectedFile.name);
});

let data = [{
	'name': 'jayanth',
	'data': 'scd',
	'abc': 'sdef'
}];

$('#upload').click(() => {
	XLSX.utils.json_to_sheet(data, 'out.xlsx');

	if(selectedFile){
		let fileReader = new FileReader();

		fileReader.readAsBinaryString(selectedFile);

		fileReader.onload = (event)=>{
			let data = event.target.result;
			let workbook = XLSX.read(data,{type: 'binary'});

			workbook.SheetNames.forEach(sheet => {
				let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);

				rowObject = rowObject.map((item) => {
					return {
						'Brand': item['Марка'],
						'Model': item['Модель'],
						'Year': item['Год']
					};
				});

				$.ajax({
					type: 'POST',
					url: '/addAutomobiles',
					data: {
						'_token': $('meta[name=csrf-token]')[0].content,
						'automibiles': JSON.stringify(rowObject)
					},
					success: function (data) {
						let html = '';
				
						data.forEach((item) => {
							html += '<tr><td>' + item['Brand'] + '</td><td>' + item.Model + '</td><td>' + item['Year'] +'</td></tr>';
						});

						$('#automobiles').html(html);
					},
					error: function (e) {
						console.error(e);
					}
				});
			});
		}
	}
});