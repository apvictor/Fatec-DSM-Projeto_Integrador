import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { Geolocation } from '@ionic-native/geolocation/ngx';

@Component({
  selector: 'app-details-units',
  templateUrl: './details-units.page.html',
  styleUrls: ['./details-units.page.scss'],
})
export class DetailsUnitsPage implements OnInit {

  public id: any;

  public unidade: any = [];
  public doctor: any = [];

  map: google.maps.Map;
  minhaPosicao: google.maps.LatLng;

  private direction = new google.maps.DirectionsService();
  private directionsRender = new google.maps.DirectionsRenderer();

  @ViewChild('map', { read: ElementRef, static: false }) mapRef: ElementRef;

  constructor(
    private activateRoute: ActivatedRoute,
    private authService: AuthService,
    public http: HttpClient,
    private geolacation: Geolocation,
  ) {
  }

  async ngOnInit() {
    this.id = this.activateRoute.snapshot.paramMap.get('id');
    this.buscarMinhaPosicao();
    this.authService.unitsDetails(this.id).subscribe(
      (units) => {
        this.unidade = units['units'];
        this.doctor = units['doctor'];
        console.log(this.doctor);
        this.exibirMapa();
        this.tracarRota(this.unidade.unit);
      }
    );
  }

  exibirMapa() {
    this.buscarMinhaPosicao();
    const opcoes = {
      center: this.minhaPosicao,
      zoom: 15,
      disableDefaultUI: true
    };

    this.map = new google.maps.Map(this.mapRef.nativeElement, opcoes);
  }

  async buscarMinhaPosicao() {
    this.geolacation.getCurrentPosition({
      timeout: 10000,
      enableHighAccuracy: true
    }).then((resp) => {
      this.minhaPosicao = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
      this.irParaMinhaPosicao();
    })
      .catch((error) => {
        console.log('Erro', error);
      })
  }

  irParaMinhaPosicao() {
    this.map.setCenter(this.minhaPosicao);
    this.map.setZoom(15);
  }


  async tracarRota(unidadePosicao) {
    new google.maps.Geocoder().
      geocode({ address: unidadePosicao },
        resultado => {
          this.map.setCenter(resultado[0].geometry.location);

          const rota: google.maps.DirectionsRequest = {
            origin: this.minhaPosicao,
            destination: unidadePosicao,
            unitSystem: google.maps.UnitSystem.METRIC,
            travelMode: google.maps.TravelMode.DRIVING
          }

          this.direction.route(rota, (result, status) => {
            if (status == 'OK') {
              this.directionsRender.setMap(this.map);
              this.directionsRender.setDirections(result);
            }
          });

        });
  }

}
