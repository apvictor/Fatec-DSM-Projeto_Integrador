import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage {

  login = {
    email: '',
    password: ''
  }

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
  ) { }

  register = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])),
    password: new FormControl('', [Validators.required, Validators.minLength(6)]),
  });

  async doRegister() {
    const loading = await this.loadingCtrl.create({ message: 'Registrando...' });
    await loading.present();

    this.authService.register(this.register.value).subscribe(
      async success => {
        const toast = await this.toastCtrl.create({ message: 'Usuário criado', duration: 2000, color: 'dark' });
        await toast.present();
        this.login.email = this.register.value.email;
        this.login.password = this.register.value.password;
        loading.dismiss();
        const loadingLogin = await this.loadingCtrl.create({ message: 'Entrando...' });
        await loadingLogin.present();
        this.authService.login(this.login).subscribe(() => {
          loadingLogin.dismiss();
          this.router.navigateByUrl('/home');
        });
        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha ao cadastrar',
          message: error.error.message,
          buttons: ['OK']
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    );
  }

}
