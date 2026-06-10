using Microsoft.EntityFrameworkCore;
using RegisseurEnFilm.API.DTO.Regisseurs;
using RegisseurEnFilm.Domain.Data;
using RegisseurEnFilm.Domain.Entities;

namespace RegisseurEnFilm.API.Repositories
{
    public class RegisseurRepository
    {
        private readonly FilmContext filmContext;

        public RegisseurRepository(FilmContext filmContext) 
        {
            this.filmContext = filmContext;
        }
        public IEnumerable<RegisseurListItem> GeefAlleRegisseurs()
        {
            List<RegisseurListItem> returnRegisseurs = new List<RegisseurListItem>();
            var regisseurs = filmContext.Regisseurs.Include(n => n.Films).Select(n => n);
            foreach (var regisseur in regisseurs)
            {
                returnRegisseurs.Add(new RegisseurListItem()
                {
                    Id = regisseur.Id,
                    Naam = regisseur.Naam,
                });
            }
            return returnRegisseurs;
        }
        public IEnumerable<RegisseurListItem> ZoekNaarRegisseur(string naam)
        {
            var zoekRegisseur = filmContext.Regisseurs
                .Where(r => r.Naam.Contains(naam))
                .Select(r => new RegisseurListItem
                {
                    Id = r.Id,
                    Naam = r.Naam,
                })
                .ToList();

            return zoekRegisseur;
        }

        public RegisseurDetailItem GeefRegisseurById(int id)
        {
            var getRegisseur = filmContext.Regisseurs
                .Include(r => r.Films)
                .FirstOrDefault(r => r.Id == id);

            if (getRegisseur == null) return null;

            return new RegisseurDetailItem
            {
                Id = getRegisseur.Id,
                Naam = getRegisseur.Naam,
                lijstVanFilms = getRegisseur.Films.Select(f => new RegisseurDetailItem.FilmLijst
                {
                    Id = f.Id,
                    Titel = f.Titel
                }).ToList()
            };
        }

        public void maakRegisseurAan(RegisseurCreateRequest request)
        {
            var newRegisseur = new Regisseur
            {
                Naam = request.Naam
            };

            filmContext.Add(newRegisseur);
            filmContext.SaveChanges();
        }
    }
}
