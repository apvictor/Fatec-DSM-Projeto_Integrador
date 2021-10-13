import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  user: any = [];
  choose = true;
  lock = "lock-closed";

  constructor(
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
    public http: HttpClient
  ) { }

  form = new FormGroup({
    name: new FormControl('', [Validators.required, Validators.minLength(4)]),
    email: new FormControl('', Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')])),
  });

  async ngOnInit() {

    const loading = await this.loadingCtrl.create({ message: 'Carregando...' });
    loading.present();

    this.authService.profile().subscribe(
      async users => {
        this.user = users['user'];
        loading.dismiss();
        console.log(this.user);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha',
          message: error.error.message,
          buttons: [{
            text: 'OK',
            handler: () => { this.router.navigateByUrl('/login') }
          }],
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }

  async update() {
    const loading = await this.loadingCtrl.create({ message: 'Atualizando...' });
    await loading.present();

    this.authService.update(this.form.value, this.user.id).subscribe(
      async success => {
        loading.dismiss();
        this.router.navigateByUrl('/profile');
        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha ao atualizar',
          message: error.error.message,
          buttons: ['OK']
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }

  chooseEdit() {
    if (this.choose == false) {
      this.choose = true;
      this.lock = 'lock-closed';
    } else {
      this.choose = false;
      this.lock = 'lock-open';
    }
  }

}
