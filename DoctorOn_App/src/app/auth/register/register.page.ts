import { Component, OnInit } from '@angular/core';
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

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
  ) { }


  // eslint-disable-next-line @typescript-eslint/member-ordering
  register = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])),
    password: new FormControl('', [Validators.required]),
  });

  async doRegister() {
    const loading = await this.loadingCtrl.create({ message: 'Registrando...' });
    await loading.present();

    this.authService.register(this.register.value).subscribe(
      async success => {
        const toast = await this.toastCtrl.create({ message: 'Usuário criado', duration: 2000, color: 'dark' });
        await toast.present();
        loading.dismiss();
        this.router.navigateByUrl('/login');
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
