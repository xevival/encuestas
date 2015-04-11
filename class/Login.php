<?php

/**
 * Description of Login
 *
 * @author Pepino
 */
class Login {

    /**
     * Funcion que muestra el formulario de login en la pantalla principal
     */
    public static function mostrarFormulario() {

        $html  = '<div class="col-md-4"></div>';
        $html .= '<div class="col-md-4 well bs-component id="form">';

        $html.= '<form class="form-horizontal" action="login.php?do=doLogin" method="POST">
                    <fieldset>
                      <legend>Acceso a Encuestas</legend>
                      <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">DNI</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="inputEmail" placeholder="DNI">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                          <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                          <button type="reset" class="btn btn-default">Borrar</button>
                          <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  <a href="alta_usurio.php" class="btn btn-link">Eres Nuevo?</a><a href="alta_usurio.php" class="btn btn-link">Has olvidado tu contraseña?</a>';
        $html.='</div>';
        echo $html;
    }

}
