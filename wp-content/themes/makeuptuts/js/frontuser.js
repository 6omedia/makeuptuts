
// // jQuery(document).ready(function($){

// 	class Validator {

//         isValid(){

//             var valid = true;

//             for(var i=0; i<this.fields.length; i++){

//             	// console.log(this.fields[i]);

//             	jQuery(this.fields[i].elem).removeClass('invalidate');
//                 var validationType = this.fields[i].validation;

//                 switch(validationType){
//                     case 'email':
                        
//                         if(jQuery(this.fields[i].elem).val() === '' || jQuery(this.fields[i].elem).val().indexOf('@') == -1){
//                             this.invalidate(this.fields[i].elem, 'Invalid Email');
//                             valid = false;
//                         }

//                         break;
//                     default:

//                         if(jQuery(this.fields[i].elem).val() == ""){
//                             this.invalidate(this.fields[i].elem, 'Missing Fields');
//                             valid = false;
//                         }    

//                 }

//             }

//             return valid;

//         }

//         invalidate(elem, msg){
//             jQuery(elem).addClass('invalidate');
//         }

//         constructor(fields){
//             this.fields = fields;
//         }

//     }

// 	var fields = [
// 		{
// 			validation: '',
// 			elem: jQuery('#first_name')
// 		},
// 		{
// 			validation: '',
// 			elem: jQuery('#last_name')
// 		},
// 		{
// 			validation: 'email',
// 			elem: jQuery('#email')
// 		},
// 		{
// 			validation: '',
// 			elem: jQuery('#username')
// 		},
// 		{
// 			validation: 'password',
// 			elem: jQuery('#pwd1')
// 		},
// 		{
// 			validation: 'password',
// 			elem: jQuery('#pwd2')
// 		}
// 	]; 

// 	var regForm = new Validator(fields);

// 	// console.log(regForm.isValid());

// 	jQuery('#submit').on('click', function(){
		
// 		if(regForm.isValid()){
// 			// console.log('dvsd');
// 			jQuery('#regForm').submit();
// 		}
	
// 	});

// // });