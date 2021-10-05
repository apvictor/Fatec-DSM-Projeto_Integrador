import { HomePage } from './../home/home.page';
import { AuthService } from './../services/auth.service';
import { Component, OnInit } from '@angular/core';
import { LoadingController, NavController, AlertController, ToastController } from '@ionic/angular';
import { HomePageModule } from '../home/home.module';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.page.html',
  styleUrls: ['./auth.page.scss'],
})

export class AuthPage {

  private activeForm: string;

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
  ) {
    this.activeForm = 'login';
  }

  login = new FormGroup({
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  register = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  async doLogin() {
    const loading = await this.loadingCtrl.create({ message: 'Entrando...' });
    await loading.present();

    this.authService.login(this.login.value).subscribe(
      async success => {
        loading.dismiss();
        // this.router.navigateByUrl('/home');
        console.log(success);
      },
      async () => {
        const alert = await this.alertCtrl.create({ message: 'Falha ao tentar entrar', buttons: ['OK'] });
        loading.dismiss();
        await alert.present();
        console.log();
      }
    )
  }

  async doRegister() {
    const loading = await this.loadingCtrl.create({ message: 'Registrando...' });
    await loading.present();

    this.authService.register(this.register.value).subscribe(
      async success => {
        const toast = await this.toastCtrl.create({ message: 'Usuário criado', duration: 2000, color: 'dark' });
        await toast.present();
        loading.dismiss();
        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({ message: 'Há um erro', buttons: ['OK'] });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }
}

