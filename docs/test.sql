
select distinct
node.nid AS ID, 
left(field_status_change_date_value,10) as 'Status Updated Date',
left(field_activity_date_value,10) as 'Activity Date',
field_claim_type_value as 'Claim Type', 
field_current_claim_status_value as 'Claim Status', 
field_business_name_value as 'DBA', 
field_claim_date_value as 'Claim Date', 
field_activity_status_value as 'Acitivity Status', 
concat(fn.field_user_firstname_value, ' ', ln.field_user_lastname_value) as 'Compliance Officer'
from 
node
LEFT JOIN field_data_field_claim_type ON node.nid = field_data_field_claim_type.entity_id
LEFT JOIN field_data_field_activity_summary FAS ON node.nid = FAS.entity_id
LEFT JOIN field_data_field_activity_status ON FAS.field_activity_summary_target_id = field_data_field_activity_status.entity_id
LEFT JOIN field_data_field_status_change_date ON FAS.field_activity_summary_target_id = field_data_field_status_change_date.entity_id AND field_status_change_date_value is not null
LEFT JOIN field_data_field_activity_date ON FAS.field_activity_summary_target_id = field_data_field_activity_date.entity_id
LEFT join field_data_field_compliance_officer CO on CO.entity_id = node.nid
LEFT join field_data_field_user_firstname fn on fn.entity_id = CO.field_compliance_officer_target_id
LEFT join field_data_field_user_lastname ln on ln.entity_id = CO.field_compliance_officer_target_id
LEFT JOIN field_data_field_claim_date ON field_data_field_claim_date.entity_id = node.nid
LEFT JOIN field_data_field_business_name ON field_data_field_business_name.entity_id = node.nid
LEFT JOIN field_data_field_current_claim_status ON field_data_field_current_claim_status.entity_id = node.nid
WHERE ((field_claim_type_value = 'hcso') OR (field_claim_type_value = 'PPLO') )
AND
(   (field_activity_status_value = 'Closed_full') 
    OR (field_activity_status_value = 'Closed_uncollect') 
    OR (field_activity_status_value = 'Closed_refered') 
    OR (field_activity_status_value = 'Closed_invalid') 
    OR (field_activity_status_value = 'Closed_noclaimant_companydissolved') 
    OR (field_activity_status_value = 'Closed_remedied') 
)
order by node.nid;
INTO OUTFILE 'closed_cases3.csv'
FIELDS TERMINATED BY ','  
ENCLOSED BY '"' LINES TERMINATED BY '\n';


select distinct
node.nid AS nid,
field_activity_status_value as activity_status
from 
node
LEFT JOIN field_data_field_claim_type ON node.nid = field_data_field_claim_type.entity_id
LEFT JOIN field_data_field_activity_summary FAS ON node.nid = FAS.entity_id
LEFT JOIN field_data_field_activity_status ON FAS.field_activity_summary_target_id = field_data_field_activity_status.entity_id
WHERE ((field_claim_type_value = 'hcso') OR (field_claim_type_value = 'PPLO') )
AND
(   (field_activity_status_value = 'Closed_full') 
    OR (field_activity_status_value = 'Closed_uncollect') 
    OR (field_activity_status_value = 'Closed_refered') 
    OR (field_activity_status_value = 'Closed_invalid') 
    OR (field_activity_status_value = 'Closed_noclaimant_companydissolved') 
    OR (field_activity_status_value = 'Closed_remedied') 
);
