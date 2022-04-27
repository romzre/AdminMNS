<<<<<<< HEAD:app/Entity/Form.php
<?php

class Form 
{
  
    /**
     * createInputText permet de creer un bloc Div > Label + input. Le param Label est optionnel. Il prendra la valeur de name si rien n'est entrer.
     * 
     *
     * @param  mixed $name
     * @param  mixed $typeInput
     * @param  mixed $label
     * @param  mixed $class
     * @return void
     */
    public function createInputText(string $name, string $typeInput, $label = NULL, string $class = NULL,string $value = NULL)
    {
        $desc = $label === NULL ? $name : $label ;

        ?>
        
        <div class="<?= $class ?>">
        <label for="<?= $name ?>"><?= $desc ?></label>
        <input type="<?= $typeInput ?>" name="<?= $name ?>" id="<?= $name?>" value="<?= $value ?>">
        </div>

    <?php
        if(isset($_POST['submit-register']))
        {
            $this->CheckForUX($value);
        }
    } 
    
    /**
     * createInputRadio permet de creer un bloc radio
     *
     * @param  mixed $context
     * @param  mixed $name
     * @param  mixed $value
     * @return void
     */
    public function createInputRadio(string $name,string $value,$id)
    { ?>

        <div>
          <input type="radio" name="<?= $name ?>" id="<?= $id ?>" value="<?= $value ?>">
          <label for="<?= $id ?>"><?= $value  ?></label>
        </div>
    <?php
    }
    
    /**
     * createBalise Permet de crée n'importe quelle balise et de rajouter une valeurà l'interieur
     *
     * @param  mixed $value
     * @param  mixed $balise
     * @return void
     */
    public function createBalise(string $value, $balise)
    { ?>
      <?php return ?>  <<?= $balise ?>><<?= $balise ?>><?= $value ?></<?= $balise ?>><<?= $balise ?>>

    <?php
    }

    
    /**
     * createTextArea Permet de créer Un input de type textArea.
     *
     * @param  mixed $name
     * @param  mixed $cols
     * @param  mixed $row
     * @param  mixed $value
     * @return void
     */
    public function createTextArea(string $name, int $cols, int $row, $value = null)
    { ?>
        
        <textarea name="<?= $name ?>" cols="<?= $cols ?>" rows="<?= $row ?>"></textarea>

    <?php
    }
    
    /**
     * createSelect permet de créer une balise select. $trainnigs doit être un tableau contenant les differents choix
     *
     * @param  mixed $trainnings
     * @param  mixed $context
     * @return void
     */
    public function createSelect(array $trainnings, string $context , string $name)
    {?>
        <div>
            <label for="<?= $name ?>"><?= $context ?></label>
        
            <select name="<?= $name ?>">
                <option value="">--Please choose an option--</option>
                <?php foreach ($trainnings  as $indice => $trainning) : ?>
        
                <option value="<?= $indice ?>"><?= $trainning ?></option>
            
                <?php endforeach ; ?>
            </select>
           
        </div>
        

    <?php
    }
    
       
    /**
     * createSubmit
     *
     * @param  mixed $class
     * @param  mixed $name
     * @return void
     */
    public function createSubmit(string $classCont,string $classInput,string $name )
    {?>
        <div class="<?= $classCont ?>"  >
        <input class="<?= $classInput ?>" type="submit" name="<?= $name ?>" id="<?= $name ?>">
        </div>

        <?php
    }
    
    /**
     * CheckForUX Vérifie si une valeur est présente dans l'input
     *
     * @param  mixed $input
     * @return void
     */
    public function CheckForUX($input)
    {
        if(empty($input)) : ?>
        <div class='check-form'>
            <span class="active">Ce champ est obligatoire</span>
        </div>

    <?php endif; 
            }

}




=======
<?php

class Form 
{
  
    /**
     * createInputText permet de creer un bloc Div > Label + input. Le param Label est optionnel. Il prendra la valeur de name si rien n'est entrer.
     * 
     *
     * @param  mixed $name
     * @param  mixed $typeInput
     * @param  mixed $label
     * @param  mixed $class
     * @return void
     */
    public function createInputText(string $name, string $typeInput, $label = NULL, string $class = NULL,string $value = NULL)
    {
        $desc = $label === NULL ? $name : $label ;

        ?>
        
        <div class="<?= $class ?>">
        <label for="<?= $name ?>"><?= $desc ?></label>
        <input type="<?= $typeInput ?>" name="<?= $name ?>" id="<?= $name?>" value="<?= $value ?>">
        </div>

    <?php
        if(isset($_POST['submit-register']))
        {
            $this->CheckForUX($value);
        }
    } 
    
    /**
     * createInputRadio permet de creer un bloc radio
     *
     * @param  mixed $context
     * @param  mixed $name
     * @param  mixed $value
     * @return void
     */
    public function createInputRadio(string $name,string $value,$id)
    { ?>

        <div>
          <input type="radio" name="<?= $name ?>" id="<?= $id ?>" value="<?= $value ?>">
          <label for="<?= $id ?>"><?= $value  ?></label>
        </div>
    <?php
    }
    
    /**
     * createBalise Permet de crée n'importe quelle balise et de rajouter une valeurà l'interieur
     *
     * @param  mixed $value
     * @param  mixed $balise
     * @return void
     */
    public function createBalise(string $value, $balise)
    { ?>
      <?php return ?>  <<?= $balise ?>><<?= $balise ?>><?= $value ?></<?= $balise ?>><<?= $balise ?>>

    <?php
    }

    
    /**
     * createTextArea Permet de créer Un input de type textArea.
     *
     * @param  mixed $name
     * @param  mixed $cols
     * @param  mixed $row
     * @param  mixed $value
     * @return void
     */
    public function createTextArea(string $name, int $cols, int $row, $value = null)
    { ?>
        
        <textarea name="<?= $name ?>" cols="<?= $cols ?>" rows="<?= $row ?>"></textarea>

    <?php
    }
    
    /**
     * createSelect permet de créer une balise select. $trainnigs doit être un tableau contenant les differents choix
     *
     * @param  mixed $trainnings
     * @param  mixed $context
     * @return void
     */
    public function createSelect(array $trainnings, string $context , string $name)
    {?>
        <div>
            <label for="<?= $name ?>"><?= $context ?></label>
        
            <select name="<?= $name ?>">
                <option value="">--Please choose an option--</option>
                <?php foreach ($trainnings  as $indice => $trainning) : ?>
        
                <option value="<?= $indice ?>"><?= $trainning ?></option>
            
                <?php endforeach ; ?>
            </select>
           
        </div>
        

    <?php
    }
    
       
    /**
     * createSubmit
     *
     * @param  mixed $class
     * @param  mixed $name
     * @return void
     */
    public function createSubmit(string $classCont,string $classInput,string $name )
    {?>
        <div class="<?= $classCont ?>"  >
        <input class="<?= $classInput ?>" type="submit" name="<?= $name ?>" id="<?= $name ?>">
        </div>

        <?php
    }

    public function CheckForUX($input)
    {
        if(empty($input)) : ?>
        <div class='check-form'>
            <span class="active">Ce champ est obligatoire</span>
        </div>

    <?php endif; 
            }

}




>>>>>>> dev-amelie:src/Entity/Form.php
?>