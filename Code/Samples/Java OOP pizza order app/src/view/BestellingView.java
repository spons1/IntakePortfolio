package view;

import javafx.geometry.Insets;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import model.Pizza;

public class BestellingView
{
	private Label lblNaam;
	private Label lblAdres;
	private Label lblMobiel;
	private Label lblPizza;
	
	private TextField txtNaam;
	private TextField txtAdres;
	private TextField txtMobiel;
	private ComboBox<Pizza> cbPizza;
	
	private Button btnVoegToe;
	private Button btnVerzendBestelling;
	private Button btnNieuweBestelling;
	
	private TextArea txtToonBestelling;
	
	public BestellingView(GridPane p) 
	{
		p.setHgap(10); 
		p.setVgap(10);
		p.setPadding(new Insets(10, 10, 10, 10));
		
		lblNaam = new Label("Naam");
		lblAdres = new Label("Adres");
		lblMobiel = new Label("Mobiel");
		lblPizza = new Label("Pizza");
		
		p.add(lblNaam, 0, 0);
		p.add(lblAdres, 0, 1);
		p.add(lblMobiel, 0, 2);
		p.add(lblPizza, 0, 3);
		
		txtNaam = new TextField();
		txtNaam.setPromptText("Naam");
		
		txtAdres = new TextField();
		txtAdres.setPromptText("Adres");
		
		txtMobiel = new TextField();
		txtMobiel.setPromptText("Mobiel");
		
		cbPizza = new ComboBox<Pizza>();
		
		p.add(txtNaam, 1, 0);
		p.add(txtAdres, 1, 1);
		p.add(txtMobiel, 1, 2);
		p.add(cbPizza, 1, 3);
		
		btnVoegToe = new Button("Voeg Toe");
		btnVerzendBestelling = new Button("Verzend Bestelling");
		btnNieuweBestelling = new Button("Nieuwe Bestelling");
		
		p.add(btnVoegToe, 1, 4);
		p.add(btnVerzendBestelling, 1, 5);
		p.add(btnNieuweBestelling, 1, 8);
		
		txtToonBestelling = new TextArea();
		txtToonBestelling.setPrefWidth(250);
		txtToonBestelling.setPrefHeight(150);
		txtToonBestelling.setEditable(false);
		
		p.add(txtToonBestelling, 2, 0, 1, 9);
	}

	public TextField getTxtNaam()
	{
		return txtNaam;
	}

	public void setTxtNaam(TextField txtNaam)
	{
		this.txtNaam = txtNaam;
	}

	public TextField getTxtAdres()
	{
		return txtAdres;
	}

	public void setTxtAdres(TextField txtAdres)
	{
		this.txtAdres = txtAdres;
	}

	public TextField getTxtMobiel()
	{
		return txtMobiel;
	}

	public void setTxtMobiel(TextField txtMobiel)
	{
		this.txtMobiel = txtMobiel;
	}

	public ComboBox<Pizza> getCbPizza()
	{
		return cbPizza;
	}

	public void setCbPizza(ComboBox<Pizza> cbPizza)
	{
		this.cbPizza = cbPizza;
	}

	public Button getBtnVoegToe()
	{
		return btnVoegToe;
	}

	public void setBtnVoegToe(Button btnVoegToe)
	{
		this.btnVoegToe = btnVoegToe;
	}

	public Button getBtnVerzendBestelling()
	{
		return btnVerzendBestelling;
	}

	public void setBtnVerzendBestelling(Button btnVerzendBestelling)
	{
		this.btnVerzendBestelling = btnVerzendBestelling;
	}

	public Button getBtnNieuweBestelling()
	{
		return btnNieuweBestelling;
	}

	public void setBtnNieuweBestelling(Button btnNieuweBestelling)
	{
		this.btnNieuweBestelling = btnNieuweBestelling;
	}

	public TextArea getTxtToonBestelling()
	{
		return txtToonBestelling;
	}

	public void setTxtToonBestelling(TextArea txtToonBestelling)
	{
		this.txtToonBestelling = txtToonBestelling;
	}
	
	public void resetInvoer()
	{
		txtToonBestelling.clear();
		txtNaam.clear();
		txtAdres.clear();
		txtMobiel.clear();	
		cbPizza.setValue(null);
	}
}
