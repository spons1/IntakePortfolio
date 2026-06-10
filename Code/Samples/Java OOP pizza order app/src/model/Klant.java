package model;

public class Klant
{
	private int id;
	private String naam;
	private String adres;
	private String mobiel;
	
	public Klant(String naam, String adres, String mobiel) 
	{
		this.naam = naam;
		this.adres = adres;
		this.mobiel = mobiel;
	}

	public int getId() 
	{
		return id;
	}
	
	public void setId(int id) 
	{
		this.id = id;
	}
	
	public String getNaam()
	{
		return naam;
	}

	public void setNaam(String naam)
	{
		this.naam = naam;
	}

	public String getAdres()
	{
		return adres;
	}

	public void setAdres(String adres)
	{
		this.adres = adres;
	}

	public String getMobiel()
	{
		return mobiel;
	}

	public void setMobiel(String mobiel)
	{
		this.mobiel = mobiel;
	}
}
