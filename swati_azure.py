import pandas as pd
import numpy as np

# sample schema file
'''
COLNAME,DATATYPE
YEAR,FLOAT
CODE,NVARCHAR
NAME,NVARCHAR
GRP,NVARCHAR
VARIABLE,NVARCHAR
VALUE,NVARCHAR
UNIT,NVARCHAR
'''

# sample mapping file 
'''
DTYPE,PDTYPE
NVARCHAR,object
BIGINT,int64
FLOAT,float64
'''

schema_file_name='schema.txt'
mapping_file_name='mapping.txt'

def gen_data_dict(filename):
  lines=open(filename,'r').read().splitlines()
  # skipping blank lines if any and also the header line
  lines_list = [line for line in lines if line][1:]
  #convert list into dictionary
  lines_dict = dict(line.split(',') for line in lines_list)
  return lines_dict

# load the values in the dictionary from the corresponding files 
schema_dict=gen_data_dict(schema_file_name)
mapping_dict=gen_data_dict(mapping_file_name)


df=pd.read_csv('test.csv')
#print('Before correction \n',df.dtypes)

type_cast_df={}
for col in df.columns:
  mapped_col_value=str(mapping_dict[schema_dict[col]])
  if str(df[col].dtype) != mapped_col_value:
    print(col,' loaded as ',df[col].dtype,' but mapped as ',mapped_col_value)    
    type_cast_df[col]=mapped_col_value


# change dtypes for the columns as per mapping 
df=df.astype(type_cast_df)

print('After type cast correction')
print(df.dtypes)

