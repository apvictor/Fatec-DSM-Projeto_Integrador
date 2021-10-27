import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private router: Router,
  ) { }

  login = new FormGroup({
    email: new FormControl('', Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])),
    password: new FormControl('', [Validators.required, Validators.minLength(6)]),
  });

  async doLogin() {
    let token = localStorage.getItem('token');
    if (token != '') {
      localStorage.clear;
    }
    const loading = await this.loadingCtrl.create({ message: 'Entrando ...' });
    await loading.present();

    this.authService.login(this.login.value).subscribe(
      async success => {
        localStorage.setItem('token', success.token);
        loading.dismiss();
        this.router.navigateByUrl('/home');
        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha ao entrar',
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
