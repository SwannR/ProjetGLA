import java.net.*;
import java.io.*;
import java.util.*;
import org.json.*;

class Sortie{

    private static String GooglePlacesKey = "AIzaSyCxacUVCDV9zoUdwjqkHw_X1jubcWvxPUA";

    public static Double[] Coordonnees(String adresse) throws Exception{
        
     System.setProperty("https.proxyHost", "cache.u-psud.fr");
	 System.setProperty("https.proxyPort", "8080");
        // 46+Rue+Du+Luxembourg,+Paris
	 URL url = new URL("https://maps.googleapis.com/maps/api/geocode/json?address=" + adresse + "&key=" +               GooglePlacesKey);
	 Scanner scan = new Scanner(url.openStream());
	 String html_output = new String();
	 while (scan.hasNext())
	     html_output += scan.nextLine();
	 scan.close();

	 JSONObject j = new JSONObject(html_output);

	 System.out.println ("Coordonnées : ");
	    JSONObject lieu = (j.getJSONArray("results")).getJSONObject (0);
        JSONObject geo = lieu.getJSONObject("geometry");
        JSONObject loc = geo.getJSONObject("location"); 
        System.out.println ("  -> latitude : " + loc.getDouble("lat")); 
        System.out.println ("  -> longitude : " + loc.getDouble("lng"));
    Double lat = loc.getDouble("lat");
    Double lng = loc.getDouble("lng");     
    Double coordo[] = {lat,lng};    
    return coordo;
	 }


    public static Double[] CoordonneesMoyennes (int Nb, Double coor[][]) {           
        Double lat = coor[0][0];        
        for (int i=1; i<Nb; i++) {
            lat = lat + coor[i][0]; 
        }
        lat = lat/Nb;
        Double lng = coor[0][1];        
        for (int i=1; i<Nb; i++) {
            lng = lng + coor[i][1]; 
        }
        lng = lng/Nb;
        Double res[] = {lat,lng};
        return res;
    }
    
    public static void AjouterEtapes(Double CoorM[], String Etape) throws Exception{
	 System.setProperty("https.proxyHost", "cache.u-psud.fr");
	 System.setProperty("https.proxyPort", "8080");
        
	 URL url = new URL("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" + CoorM[0] + "," + CoorM[1] + "&radius=500&type=" + Etape + "&name=" + Etape + "&key=" + GooglePlacesKey);
	 Scanner scan = new Scanner(url.openStream());
	 String html_output = new String();
	 while (scan.hasNext())
	     html_output += scan.nextLine();
	 scan.close();

	 JSONObject j = new JSONObject(html_output);

	 System.out.println ("J'ai envie d'un bon " + Etape);
	 for (int i = 0 ; i < j.getJSONArray("results").length() ; i++){
	     JSONObject lieu = (j.getJSONArray("results")).getJSONObject (i);
	     System.out.println ("  -> " + lieu.getString ("name") + ", " + lieu.getString ("vicinity"));
	 }
    }
    
     public static void main(String[] args) throws Exception{
        Double coor[][] = new Double[9][2];
        int NbParticipants = 0;
        coor[0] = Coordonnees("9+Avenue+Foch,+Paris");
        NbParticipants ++;
        coor[1] = Coordonnees("35+Rue+De+Lille,+Paris");
        NbParticipants ++;        
        coor[2] = Coordonnees("5+Avenue+Des+Champs+Elysees,+Paris");
        NbParticipants ++;
        Double CoorMoyenne[] = CoordonneesMoyennes(NbParticipants, coor);        
        AjouterEtapes(CoorMoyenne, "restaurant");
        
    }



}
