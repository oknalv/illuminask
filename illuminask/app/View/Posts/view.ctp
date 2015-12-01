<!-- File: /app/View/Posts/view.ctp -->
  <div><!--pregunta-->
    <div class="custom-question-header col-sm-12 col-md-12"><!-- div titulo-->
      <h2 class="custom-question-title">
          <?php
            echo $this->Html->image("iconoPregunta.svg", array(
              "alt" => "question",
              'class' => "custom-iconoPregunta"
            ));
            echo $post['Post']['title'];?>
      </h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12"><!--div manos y cuerpo-->
      <div class="col-xs-1 col-sm-1 col-md-1 col-md-1 custom-votes"><!-- div manitos-->
        <div><i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i></div>
        <div class="custom-votes-number"><?= $this->Votes->calculate($post["PostVote"]);?></div>
        <div><i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i></div>
      </div>
      <div class="col-xs-11 col-sm-11 col-md-11 custom-question-description"><!-- div cuerpo-pregunta-->
          <?php echo $post['Post']['content']?>
      </div>
    </div>
    <div>
      <div class="custom-comment col-xs-6 col-sm-6 col-md-6">
        <a href="#" class="custom-comment-link" id="firstLink-comment"><?= __("Add a comment"); ?></a>
      </div>
      <div class="custom-user col-xs-6 col-sm-6 col-md-6">
        <div class="custom-square-user">
          <p class="custom-date">
            <?php
              $ago=$this->Date->ago($post['Post']['date']);
              echo sprintf(__("Asked %s",sprintf(__('%s ago'),sprintf(__($ago['units']),__($ago['value'])))));
            ?>
          </p>
          <?= $this->Html->link($post['User']['name'], array(
            'controller' => 'users',
            'action' => 'view',$post['User']['id']),
            array('class' => 'custom-user-link')
          );?>
        </div>
      </div>
      <div hidden class="custom-insert-comment col-xs-12 col-sd-12 col-md-12" id="firstSquare-comment">
        <div>
          <form>
            <label for="comment"> Introduce your comment (necessary to log in to enable comments)</label><br>
            <textarea id="comment" rows="4" cols="148" class="form-control" disabled></textarea>
            <input type="submit" value="Send" class="custom-input-form">
            <input type="reset" value="Reset" class="custom-input-form">
          </form>
        </div>
      </div>
    </div>
  </div><!--fin div preguntas-->
  <div class=" col-xs-12 col-sd-12 col-md-12 custom-panel-answers">
    <h3><?php
          $responses = count($post['Response']);
          if($responses == 1)
            echo sprintf(__("%s answer"),$responses);
          else
            echo sprintf(__("%s answers"),$responses);
        ?>
    </h3>
  </div>
  <div class="col-xs-12 col-sd-12 col-md-12 custom-line-separator">
    <hr/>
  </div>
  <div><!-- nueva respuesta-->
    <?php if(AuthComponent::user('id')) { ?>
      <?php echo $this->Form->create('Response', array(
        "class" => "form-group",
        "action" => "add"
        )); ?>
        <h4><?= __("Enter a response"); ?></h4>
        <div class="form-group">
        <?php echo $this->Form->input('content',array(
            "type" => "textarea",
            "class" => "form-control input-lg",
            "label" => false
        ));?>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-lg-3 col-xl-2">
          <?php echo $this->Form->button(__("Send"),array(
              "class" => "custom-input-form col-xs-6 col-sm-6 col-lg-6",
              "type" => "submit"
          ));?>
          <?php echo $this->Form->button(__("Reset"),array(
              "class" => "custom-input-form col-xs-6 col-sm-6 col-lg-6",
              "type" => "reset"
          ));?>
          <?php echo $this->Form->input("post_id",array("value" => $post['Post']['id'], "type" => "hidden")); ?>
        </div>
      <?php echo $this->Form->end(); ?>
    <?php } else { ?>
        <h4><a href ="#" class="custom-comment-link" data-toggle="modal" data-target="#login"><?= __("To enter a response, please log in"); ?></a></h4>
    <?php } ?>
  </div>
  <div><!-- div respuestas-->
    <?php foreach($post['Response'] as $response){ ?>
    <div><!-- div una respuesta-->
      <div class="col-xs-12 col-sm-12 col-md-12"><!--div manos y cuerpo-->
        <div class="col-xs-1 col-sm-1 col-md-1 custom-votes"><!--div manos respuesta-->
          <div><i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i></div>
          <div class="custom-votes-number"><?= $this->Votes->calculate($response["ResponseVote"]);?></div>
          <div><i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i></div>
          <div><i class="glyphicon glyphicon-ok custom-glyphicon-best"></i></div>
        </div>
        <div class="col-xs-11 col-sm-11 col-md-11 custom-answer-description"><!-- div cuerpo respuesta -->
          <?= $response['content'];?>
        </div>
      </div>
      <div>
        <div class=" custom-comment col-xs-6 col-sm-6 col-md-6">
          <a href="#" class="custom-comment-link" id="secondLink-comment"><?= __("Add a comment"); ?></a>
        </div>
        <div class="custom-user col-xs-6 col-sm-6 col-md-6">
          <div class="custom-square-user">
            <p class="custom-date">
              <?php
                $ago=$this->Date->ago($response['date']);
                echo sprintf(__("Answered %s",sprintf(__('%s ago'),sprintf(__($ago['units']),__($ago['value'])))));
              ?>
            </p>
            <a href="#" class="custom-user-link"><?= $response["User"]["name"];?></a>
          </div>
        </div>
        <div hidden class="custom-insert-comment col-xs-12 col-sd-12 col-md-12" id="secondSquare-comment">
          <div>
            <form>
              <label for="comment"> Introduce your comment (necessary to log in to enable comments)</label><br>
              <textarea id="comment" rows="4" cols="148" class="form-control" disabled></textarea>
              <input type="submit" value="Send" class="custom-input-form">
              <input type="reset" value="Reset" class="custom-input-form">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
    <!--
    <div class="col-xs-1 col-sm-1 col-md-1 custom-votes">
      <i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i><br>
      <span class="custom-votes-number">8</span><br>
      <i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i>
      <i class="glyphicon glyphicon-ok custom-glyphicon-best"></i>
    </div>
      <!-Respuesta normal->
    <div class="col-xs-11 col-sm-11 col-md-11 custom-answer-description">
      <p>
        The sample code you have linked to appears to be using jquery.filedrop.js, which is written by Weixi
        Yen. You need to download and use the latest version from its project home for this to work.<br><br>
        You should also download and use a later version of jquery than the one bundled with that sample
        code. I have tested this with jquery 1.9.1.<br><br>
        To use the jquery extension you've chosen, you need to take advantage of the beforeSend option,
        and supply your own function. You also need to store references to the done() functions that are
        provided to your custom function for each file, so that you can call them later, causing the files to be
        uploaded.<br><br>
        If you want meta boxes to appear for each file, then you need to append the appropriate html on a per
        file basis to allow the user to fill them in.<br><br>
        A summary of the code I would suggest is below:<br><br>
      </p>
        <!-Zona de la Respuesta destacada->
      <div class="custom-squareVip-answer">
        <p class="custom-answerInto-squareVip">
          var uploads_to_call = [];  // the global to store all the file upload callbacks<br><br>
          $('#dropzone').filedrop({<br>
            fallback_id: 'upload_button',   // an identifier of a standard file input element, becomes the target of "click" events on the dropzone<br>
            url: 'upload.php',              // upload handler, handles each file separately, can also be a function taking the file and returning a url<br>
            // other important parameters related to upload, read the documentation for details<br><br>
            // this is the important custom function you need to supply<br>
            beforeSend: function(file, i, done) {<br>
                // file is a file object<br>
                // i is the file index<br>
                // call done() to start the upload<br><br>
                 // this is just to clone meta boxes for the user to fill in for each file<br>
                // it also fills in the filename so that it's obvious which meta boxes<br>
                // are for which files<br>
                $("#perfile").children().clone()<br>
                   .appendTo("#allmeta")<br>
                   .children(".filename").html(file.name);<br><br>
                 // this pushes the done() callback into the global mentioned earlier<br>
                  // so that we can call it later<br>
                  uploads_to_call.push(done);<br>
              },<br>
              afterAll: function() {<br>
                  // runs after all files have been uploaded or otherwise dealt with<br>
                  // you should possibly put code in here to clean up afterwards<br>
              }<br>
          });  <br><br>
          // set a handler to upload the files when the submit button is clicked<br>
          $("#submit").click(function(){<br>
              $.each(uploads_to_call, function(i, upcall) {<br>
                  upcall();<br>
              });<br>
          });<br>
        </p>
      </div>
    </div>
    <div >
      <!-Comentario->
      <div class=" custom-comment col-xs-6 col-sm-6 col-md-6">
        <a href="#" class="custom-comment-link" id="secondLink-comment">Add a comment</a>
      </div>
      <!-Usuario del comentario->
      <div class="custom-user col-xs-6 col-sm-6 col-md-6">
        <div class="custom-square-user">
          <p class="custom-date">Answered 2 days ago</p>
          <a href="#" class="custom-user-link">maxrespondon</a>
        </div>
      </div>
      <div hidden class="custom-insert-comment col-xs-12 col-sd-12 col-md-12" id="secondSquare-comment">
        <div>
          <form>
            <label for="comment"> Introduce your comment (necessary to log in to enable comments)</label><br>
            <textarea id="comment" rows="4" cols="148" class="form-control" disabled></textarea>
            <input type="submit" value="Send" class="custom-input-form">
            <input type="reset" value="Reset" class="custom-input-form">
          </form>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sd-12 col-md-12 custom-line-separator" >
      <hr>
    </div>
    <!-Respuesta 2->
      <!-Iconos->
    <div class="col-xs-1 col-sm-1 col-md-1 custom-votes">
      <i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i><br>
      <span class="custom-votes-number">3</span><br>
      <i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i>
    </div>
    <div class="col-xs-11 col-sm-11 col-md-11 custom-answer-description">
      <p>
        According to my research, There's no way to handle upload manually in jquery.filedrop. You can use <br>
        one of the event functions like bellow to prompt user to input some additional parameter like metadata <br>
        and etc... and then attach them into the sending data like this:<br><br>
      </p>
      <!-Zona de la Respuesta destacada->
      <div class="custom-squareVip-answer">
        <p class="custom-answerInto-squareVip">
          $('#myElement').fileDrop({<br>
              data: {<br>
                  param1: 'value1',           // send POST variables<br>
                  param2: function(){<br>
                      return calculated_data; // calculate data at time of upload<br>
                },<br>
              },<br>
              onFileRead : function(fileCollection){<br>
                  $.each(fileCollection, function(){<br>
                      //Do stuff with fileCollection here!<br>
                  });<br>
              },<br>
              drop: function() {<br>
                  // user drops file<br>
              },<br>
              beforeSend: function(file, i, done) {<br>
                  // file is a file object<br>
                  // i is the file index<br>
                  // call done() to start the upload<br>
              },<br>
              // Called before each upload is started<br>
              beforeEach: function(file){<br>
                  //do some stuff here<br>
              }<br>
          });<br>

         </p>
      </div>
    </div>
    <div>
      <!-Comentario->
      <div class="custom-comment col-xs-6 col-sm-6 col-md-6">
        <a href="#" class="custom-comment-link" id="thirdLink-comment">Add a comment</a>
      </div>
      <!-Usuario del comentario->
      <div class="custom-user col-xs-6 col-sm-6 col-md-6">
        <div class="custom-square-user">
          <p class="custom-date">Answered 2 days ago</p>
          <a href="#" class="custom-user-link">maxrespondon22</a>
        </div>
      </div>
      <div hidden class="custom-insert-comment col-xs-12 col-sd-12 col-md-12" id="thirdSquare-comment">
        <div>
          <form>
            <label for="comment"> Introduce your comment (necessary to log in to enable comments)</label><br>
            <textarea id="comment" rows="4" cols="148" class="form-control" disabled></textarea>
            <input type="submit" value="Send" class="custom-input-form">
            <input type="reset" value="Reset" class="custom-input-form">
          </form>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sd-12 col-md-12 custom-line-separator">
      <hr>
    </div>
    <!-Respuesta 3->
      <!-Iconos->
    <div class="col-xs-1 col-sm-1 col-md-1 custom-votes">
      <i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i><br>
      <span class="custom-votes-number">0</span><br>
      <i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i>
    </div>
    <div class="col-xs-11 col-sm-11 col-md-11 custom-answer-description">
      <p>
        @AmirHossein Have you tried Dropzone.js http://www.dropzonejs.com/ It seems that they have <br>
        support for a feature that you are looking for. Below is excerpt from the relevant page. I haven't tried it <br>
        myself, but purely based on documentation worth a try to check if it meets your requirements.<br>
      </p>
    </div>
    <div class="col-md-12"><!-En los otros no fue necesario meter la clase,pero aqui si->REVISAR->
      <!-Comentario->
      <div class="custom-comment col-xs-6 col-sm-6 col-md-6">
        <a href="#" class="custom-comment-link" id="fourthLink-comment">Add a comment</a>
      </div>
      <!-Usuario del comentario->
      <div class="custom-user col-xs-6 col-sm-6 col-md-6">
        <div class="custom-square-user">
          <p class="custom-date">Answered 1 day ago</p>
          <a href="#" class="custom-user-link">nuevo17</a>
        </div>
      </div>
      <div hidden class="custom-insert-comment col-xs-12 col-sd-12 col-md-12" id="fourthSquare-comment">
        <div>
          <form>
            <label for="comment"> Introduce your comment (necessary to log in to enable comments)</label><br>
            <textarea id="comment" rows="4" cols="148" class="form-control" disabled></textarea>
            <input type="submit" value="Send" class="custom-input-form">
            <input type="reset" value="Reset" class="custom-input-form">
          </form>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sd-12 col-md-12"><!-Para que no esté tan pegado al final->
      <p><br><br></p>
    </div>
