# mapper
Simply map JSON structures onto PHP classes

![build](https://travis-ci.org/elkaadka/mapper.svg?branch=master)

#How it works 


 - Map an array, an object or a json string into an object :
     ```
         $mapper = new Mapper();
         $mapper->map($from, $myClass);
      ```
      
      - the first parameter ($from) can be either an array, an object or a string
      - if the first parameter is a string but isn't a valid json, an InvalidDataException is raised
      - if the second parameter isn't an object, an InvalidDataException is raised
      - if a property (when $from is an object) or key (when $from is an array) does not exist, it will not be created.
    
 - To create a property in the target class when it does not exist: 
 
       $options = new Options();
       $options->createNewProperty(true);
       $mapper = new Mapper($options);
       $mapper->map($from, $myClass);
       
 - Transform properties:
    
      - You can transform array keys or object properties during mapping, 

      - example :
      
        -   Map the array :
            
            ```
            ['test_one' => 1] 
            ```
            
            to the object : 
            
            ```
                class Test { 
                   protected $testOne;
                }
            ```
            
            where the array key 'test_one' corresponds to the property $testOne;
            
        -   Or Map the object :
                    
                    class A { 
                       protected $testA;
                    }
                    
            to the object : 
                    
                    class B { 
                       protected $testB;
                    }
            where the property $testA of the class A corresponds to the property $testB of class B
      
      To do so you need to use Transformers :
      
      There are 4 built in Transformers  :
      
      - CamelCaseTransformer : snake or pascal case to camel case
      
            attribute-name => attributeName
            attribute_name => attributeName
            attribute name => attributeName
            Attribute_NAME => attributeName
            AttributeName  => attributeName
            attributeName  => attributeName
            attribute_firstName => attributeFirstname

      - SnakeCaseTransformer: pascal or camel case to snake case
            
            attributeName => attribute_name
            attribute => attribute
            
      - PascalCaseTransformer: snake or camel case to pascal case
            
            attribute-name => AttributeName
            attribute_name => AttributeName
            attribute name => AttributeName
            Attribute_NAME => AttributeName
            AttributeName  => AttributeName
            attributeName  => AttributeName
            attribute_firstName => AttributeFirstname
        
      - <b>CustomTransformer : allows to add your own transformer</b>
      
    You can specify a transformer for all the properties/keys or one for every property/key
     
    Examples : 
    
      - Apply a CamelCase Transformer to all the properties/keys
       
            $options = new Options();
            $options->setTransformer(new CamelCaseTransformer());
            $mapper = new Mapper($options);
   
            $class = new MyClassExample(); //Contains only one propery named $testOne;
            $data = ['test_one' => 'Hellow World'];
   
            $mapper->map($data, $class);
            
            Result :  
            
            print_r($class);
            
            Object
            (
                [testOne] => 'Hellow World'
            )
            
      - Apply a Custom Transformer to all the properties/keys
              
            $customTransformer = new CustomTransformer();
            $customTransformer->setTransformer(function($property) {
                if ($property == 'test_one') {
                    return 'name';
                }
                
                return $property; //very important or else only test_one will be mapped
            });
            $options = new Options();
            $options->setTransformer($customTransformer);
            $mapper = new Mapper($options);
    
            $class =  new MyClassExample(); //Having two Properties $name and $phone
            $data = ['test_one' => 'Jhon doe', 'phone' => 1234];
            $mapper->map($data, $class);
            
            Result :  
            
            print_r($class);
            
            Object
            (
                [name] => 'Jhon doe',
                [phone] => 1234
            )
            
      - Apply different Transformers
                    
            $customTransformer = new CustomTransformer();
            $customTransformer->setTransformer(function($property) {
               return 'name';
            });
            $options = new Options();
            $options->addPropertyTransformer('test_one', $customTransformer);
            $options->addPropertyTransformer('phone_number', new CamelCaseTransformer());
            $mapper = new Mapper($options);
  
            $class =  new MyClassExample(); //Having two Properties $name, $phoneNumber
            $data = ['test_one' => 'Jhon doe', 'phone_number' => 1234];
            $mapper->map($data, $class);
          
            Result :  
          
            print_r($class);
          
            Object
            (
                [name]  => 'Jhon doe',
                [phoneNumber] => 1234
            )

