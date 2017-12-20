# Form finisher for storing results as JSON in DB

Let you add a form finisher to store the form data as JSON in the database.

## Dependencies

This packages depends on 
- [ttree/jsonstore](https://github.com/ttreeagency/JsonStore) to store data into DB
- [neos/form-builder](https://github.com/neos/form-builder) for the form ;-)

## How to use?

1. `composer require techniconcept/formfinisher-jsonstore`
2. Add the finisher to your form

### NodeTypes based form

Add the "JsonStore Finisher" and fill the label and type to retrieve your form.

### Fusion based form (with [neos/form-fusionrenderer](https://github.com/neos/form-fusionrenderer))

Add the following Fusion code:

```neosfusion
prototype(TC.FormExample:Content.MyForm) < prototype(Neos.Form.Builder:Form) {

    # ...
    
    finishers {
        jsonStoreFinisher = TC.FormFinisher.JsonStore:Finisher.Definition {
            options {
                storeLabel = 'JsonStore label'
                storeType = 'ch.techniconcept.form-finisher.jsonstore'
            }
        }
    }

    # ...

}
``` 

## Acknowledgments

Development sponsored by [techniConcept](https://techniconcept.ch).

We try our best to craft this package with a lots of love, we are open to sponsoring, support request, ... just [contact us](https://techniconcept.ch/contact/).

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.