function update_confirmation_builder(upc_var, descriptor_var, quant_var, type_var, image_var) {
  var string_out;
  if(descriptor_var){
    string_out = '<div class="table-responsive">';
    string_out += '<table class="table-condensed">';
    string_out += '<tbody>';
    string_out += '<tr>';
    string_out += '<td>UPC updated: </td>';
    string_out += '<td>'+ upc_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
    string_out += '<td>Colloquially known as: </td>';
    string_out += '<td>'+ descriptor_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
    string_out += '<tr>';
    string_out += '<td>Previous Quantity: </td>';
    string_out += '<td>' + prior_quant + '</td>';
    string_out += '</tr>';
    string_out += '<td>Quantity changed to: </td>';
    string_out += '<td>'+ quant_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
    string_out += '<td>Product Type is of: </td>';
    string_out += '<td>' + type_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
    string_out += '<td>Looks like: </td>';
    string_out += '<td><div><img src="' + image_var + '" class="img-thumbnail" style="display: block; margin-left: none; margin-right: auto; width: 75px; height: 75px; object-fit: scale-down;"></div></td>';
    string_out += '</tr>';
    string_out += '</tbody>';
    string_out += '</table>';
    string_out += '</div>';
  }
  else{
    console.log("you suck at coding Babler!");
  }
  return string_out;
}

