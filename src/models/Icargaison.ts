import { TypeCargaison } from "../enums/TypeCargaison"
import { EtatAvancement } from '../enums/EtatAvancement';
import { EtatGlobal } from "../enums/EtatGlobal";

// Interface pour représenter un lieu avec coordonnées
export interface ILieu {
    nom: string;
    latitude: number;
    longitude: number;
    pays: string;
}

// Interface pour représenter un colis (à définir selon vos besoins)
export interface IColis {
    // Définir les propriétés du colis selon votre modèle
    id?: string;
    poids?: number;
    description?: string;
    // Ajoutez d'autres propriétés selon vos besoins
}

export interface ICargaison {
    id?: string;
    numero: string;
    poidsMax: number;
    type: TypeCargaison;
    distance: number; // Changé de distanceKm à distance
    lieuDepart: ILieu; // Changé de string à ILieu
    lieuArrivee: ILieu; // Changé de string à ILieu
    dateDepart: string | Date; // Accepter string ou Date
    dateArrivee: string | Date; // Accepter string ou Date
    etatAvancement: EtatAvancement;
    etatGlobal: EtatGlobal;
    colis: IColis[]; // Ajout du tableau de colis
}