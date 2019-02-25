function alert_type_summon(outer_type_of_insertion, outer_upc_var, outer_descript_var, outer_quant_var, outer_type_var, outer_image_var){
  let outputted_string;
  switch(outer_type_of_insertion) {
    case "SQL_Update":    
      outputted_string =  update_confirmation_builder(outer_upc_var, outer_descript_var, outer_quant_var, outer_type_var, outer_image_var);
      console.log(outputted_string);
      break;
    case "SQL_Insert":
      outputted_string = insert_confirmation_builder(outer_upc_var, outer_descript_var, outer_quant_var, outer_type_var, outer_image_var);
      break;

  }
  return outputted_string;
}

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

function insert_confirmation_builder(upc_var, descriptor_var, quant_var, type_var, image_var) {
  var string_out;
  if(descriptor_var){
    string_out = '<div class="table-responsive">';
    string_out += '<table class="table-condensed">';
    string_out += '<tbody>';
    string_out += '<tr>';
    string_out += '<td>UPC <i> Added to the database </i>: </td>';
    string_out += '<td>'+ upc_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
    string_out += '<td>Colloquially known as: </td>';
    string_out += '<td>'+ descriptor_var + '</td>';
    string_out += '</tr>';
    string_out += '<tr>';
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
    console.log("you still suck at coding Babler!");
  }
  return string_out;
}
