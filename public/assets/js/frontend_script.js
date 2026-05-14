jQuery(function($) {
"use strict";
    jQuery(document).ready(function(){
        jQuery(".woocommerce-Button, #wp-submit").click(function(e){
            if(grecaptcha.getResponse() == ""){
                alert("Select the google recaptcha");
                e.preventDefault();
            }
        });
    });

    function executeRule(fieldValue, relationString, conditionValue) {
    	var ruleTruthStatus = false;
    	switch(relationString) {
    		case 'equal_to':
    			ruleTruthStatus = fieldValue === conditionValue ? true : false;
    			break;
    		case 'not_equal_to':
    			ruleTruthStatus = fieldValue !== conditionValue ? true : false;
    			break;
    		case 'is_empty':
    			ruleTruthStatus = fieldValue === '' ? true : false;
    			break;
    		case 'not_empty':
    			ruleTruthStatus = fieldValue !== '' ? true : false;
    			break;
    		case 'greater_than':
    			ruleTruthStatus = fieldValue > conditionValue ? true : false;
    			break;
    		case 'less_than':
    			ruleTruthStatus = fieldValue < conditionValue ? true : false;
    			break;
    		case 'greater_than_or_equal_to':
    			ruleTruthStatus = fieldValue >= conditionValue ? true : false;
    			break;
    		case 'less_than_or_equal_to':
    			ruleTruthStatus = fieldValue <= conditionValue ? true : false;
    			break;
    		case 'contains':
    			ruleTruthStatus = fieldValue.indexOf(conditionValue) !== -1 ? true : false;
    			break;
    		case 'not_contains':
    			ruleTruthStatus = fieldValue.indexOf(conditionValue) === -1 ? true : false;
    			break;
    		case 'starts_with':
    			ruleTruthStatus = fieldValue.startsWith(conditionValue) ? true : false;
    			break;
    		case 'ends_with':
    			ruleTruthStatus = fieldValue.endsWith(conditionValue) ? true : false;
    			break;
    	}
    	return ruleTruthStatus;
    }

    document.addEventListener('DOMContentLoaded', function() {
	    // Conditional logic implementation
		var independentFields = [];
		$.each( fieldsRules, function(fieldID, rules) {
	    	if(rules !== null && rules !== '') {
	    		$.each(rules, function(groupIndex, ruleGroup) {
	    			$.each(ruleGroup, function(ruleIndex, rule) {
		    			if(ruleIndex !== 0 && rule.crf_conditional_field !== '' && typeof independentFields.find(e => e.independentField === rule.crf_conditional_field) === 'undefined') {
		    				independentFields.push({ 'fieldID': fieldID, 'independentField' : rule.crf_conditional_field, 'field': $('#crf_custom_field_data_'+rule.crf_conditional_field) });
		    			}
		    		});
	    		});
	    	}
	    });

	    function runDependency() {
	    	$.each(independentFields, function(index, field) {
		    	applyDependency(field.fieldID);
		    });
	    }
	    // Initialize fields dependency
	    runDependency();

	    $.each(independentFields, function(index, field) {
	    	field.field.on('change', function() {
	    		runDependency();
	    	});
	    });


	    function applyDependency(fieldID) {
	    	var fieldDependencies = fieldsRules[fieldID];
	    	var truthStatuses = [];
	    	var conjunction = '';
			var field = $('#crf_custom_field_data_'+fieldID);
			
	    	$.each(fieldDependencies, function(i, ruleGroup) {
	    		truthStatuses.push('(');
	    		$.each(ruleGroup, function(ruleIndex, rule) {
	    			if(ruleIndex === 0) {
		    			var conjunction = '';
		    			if(rule.conjunction == 'and') {
		    				conjunction = '&&';
		    			} else if(rule.conjunction == 'or') {
		    				conjunction = '||';
		    			}
		    			
		    			truthStatuses.pop();
		    			truthStatuses.push(conjunction);
		    			truthStatuses.push('(');
		    		}
					if(rule.crf_conditional_relation !== '' && ruleIndex !== 0) {
		    			var referenceFieldValue = $('#crf_custom_field_data_'+rule.crf_conditional_field).val();
						var value = rule.crf_conditional_value;
		    			var ruleTruthStatus = executeRule(
		    				referenceFieldValue,
		    				rule.crf_conditional_relation,
		    				value
		    			);
		    			
						truthStatuses.push(ruleTruthStatus);
		    			var conjunction = '';
		    			if(rule.crf_conditional_operator == 'and') {
		    				conjunction = '&&';
		    				truthStatuses.push(conjunction);
		    			} else if(rule.crf_conditional_operator == 'or') {
		    				conjunction = '||';
		    				truthStatuses.push(conjunction);
		    			}
		    			
		    		}

		    	});
		    	truthStatuses.push(')');
	    	});
			var conditionConstructsCount = truthStatuses.length;
			if(truthStatuses[conditionConstructsCount - 2] === '&&' || truthStatuses[conditionConstructsCount - 2] === '||') {
				truthStatuses.splice(conditionConstructsCount-2, 1);
			}

	    	if(truthStatuses.join(' ') !== '( )' && eval(truthStatuses.join(' '))) {
	    		field.parents('p.form-row').show();
	    	} else {
	    		field.parents('p.form-row').hide();
	    	}
	    }
	});
}(jQuery));