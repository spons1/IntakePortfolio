package controller;

import java.util.ArrayList;

import data.BestellingDAO;
import data.KlantDAO;
import data.PizzaDAO;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.layout.GridPane;
import model.Klant;
import model.Pizza;
import view.BestellingView;

public class Controller
{
	private BestellingView bestellingView;
	private BestellingDAO bestellingDAO;
	private PizzaDAO pizzaDAO;
	private KlantDAO klantDAO;
	private ArrayList<Pizza> pizzaBestelLijst;
	
	public Controller(GridPane pane) 
	{
		bestellingView = new BestellingView(pane);
		bestellingDAO = new BestellingDAO();
		pizzaDAO = new PizzaDAO();
		klantDAO = new KlantDAO();
		pizzaBestelLijst = new ArrayList<Pizza>(); 
		
		bestellingView.getBtnVoegToe().setOnAction(event -> voegPizzaToeAanBestelling());
		bestellingView.getBtnVerzendBestelling().setOnAction(event -> verzendBestelling());
		bestellingView.getBtnNieuweBestelling().setOnAction(event -> nieuweBestelling());
		
		fillComboBox();
	}
	
	private void fillComboBox() 
	{
		ArrayList<Pizza> pizzaLijst = pizzaDAO.getPizzas();
		for(Pizza pizza : pizzaLijst) 
		{
			bestellingView.getCbPizza().getItems().add(pizza);
		}
	}
	
	private boolean controleerPizzaInfo() 
	{
		if (bestellingView.getTxtNaam().getText().isEmpty() || bestellingView.getTxtAdres().getText().isEmpty() ||
				bestellingView.getTxtMobiel().getText().isEmpty())
		{
			showAlert("Voer eerst een adres in!!");
			return false;
		}
		return true;
	}
	
	private void verzendBestelling() 
	{
		if (!controleerPizzaInfo())
		{
			return;
		}
		if (pizzaBestelLijst.size() == 0)
		{
			showAlert("Geen pizza geselecteerd!");
			return;
		}
		
		Klant klant = new Klant(bestellingView.getTxtNaam().getText(), bestellingView.getTxtAdres().getText(), 
				bestellingView.getTxtMobiel().getText());
		int klantId = klantDAO.createKlant(klant);
		
		int bestelnr = 0;
		if (klantId > 0)
		{
			klant.setId(klantId);
			bestelnr = bestellingDAO.createBestelling(klant, pizzaBestelLijst);
		}
		createBestelBon();
		bestellingView.getTxtToonBestelling().appendText("\nBestelnummer: " + bestelnr);
	}
	
	private void voegPizzaToeAanBestelling()
	{
		if (!controleerPizzaInfo())
			return;
		pizzaBestelLijst.add(bestellingView.getCbPizza().getValue());
		createBestelBon();
	}
	
	private void createBestelBon()
	{
    	StringBuilder sb = new StringBuilder();
    	
    	sb.append(bestellingView.getTxtNaam().getText() + "\n");
    	sb.append(bestellingView.getTxtAdres().getText() + "\n");
    	sb.append(bestellingView.getTxtMobiel().getText() + "\n");
    	sb.append("" + "\n");
    	double totaalprijs = 0;
    	for(Pizza pizza: pizzaBestelLijst)
    	{
    		totaalprijs += pizza.getPrijs();
    		sb.append(String.format("%s    %.2f\n", pizza.getNaam(), pizza.getPrijs()));
    	}
    	
    	sb.append("\n");
    	sb.append(String.format("Totaalbedrag € %.2f\n", totaalprijs));
		
    	bestellingView.getTxtToonBestelling().setText(sb.toString());
	}
	
	private void showAlert(String message)
	{
		Alert alert = new Alert(AlertType.INFORMATION);
		alert.setContentText(message);
		alert.showAndWait();
	}
	
	private void nieuweBestelling()
    {
    	bestellingView.resetInvoer();
    	pizzaBestelLijst.clear();
    }
}
