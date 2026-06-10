using RegisseurEnFilm.API.DTO.Films;
using RegisseurEnFilm.Domain.Data;
using Microsoft.EntityFrameworkCore;
using RegisseurEnFilm.Domain.Entities;

namespace RegisseurEnFilm.API.Repositories
{
    public class FilmRepository
    {
        private readonly FilmContext filmContext;

        public FilmRepository(FilmContext filmContext) 
        {
            this.filmContext = filmContext;
        }

        public IEnumerable<FilmListItem> geefAlleFilms() 
        {
            List<FilmListItem> returnFilms = new List<FilmListItem>();
            var films = filmContext.Films.Include(n => n.Regisseur).Select(n => n);
            foreach (var film in films) 
            {
                returnFilms.Add(new FilmListItem()
                {
                    Id = film.Id,
                    Regisseur = film.Regisseur.Naam,
                    Titel = film.Titel,
                });
            }
            return returnFilms;
        }

        public IEnumerable<FilmListItem> ZoekNaarFilm(string titel)
        {
            var zoekFilms = filmContext.Films
                .Include(film => film.Regisseur)
                .Where(film => film.Titel.Contains(titel))
                .Select(film => new FilmListItem
                {
                    Id = film.Id,
                    Titel = film.Titel,
                    Regisseur = film.Regisseur.Naam
                })
                .ToList();

            return zoekFilms;
        }

        public FilmDetailItem GeefFilmById(int id) 
        {
            var film = filmContext.Films
                .Include(film => film.Regisseur)
                .FirstOrDefault(film => film.Id == id);
            if (film == null)
            {
                return null;
            }

            return new FilmDetailItem
            {
                Id = film.Id,
                Titel = film.Titel,
                Publicatiedatum = film.Publicatiedatum,
                RegisseurId = film.RegisseurID,
                RegisseurNaam = film.Regisseur?.Naam ?? "Onbekende Regisseur"
            };
        }

        public void maakFilmAan(FilmCreateRequest request)
        {
            var newFilm = new Film
            {
                Titel = request.Titel,
                Publicatiedatum = request.PublicatieDatum,
                RegisseurID = request.RegisseurId,
            };

            filmContext.Add(newFilm);
            filmContext.SaveChanges();
        }

        public bool UpdateFilm(int id,FilmUpdateRequest request)
        {
            var film = filmContext.Films.FirstOrDefault(film => film.Id == id);
            if (film == null) return false;

            film.Titel = request.Titel;
            film.Publicatiedatum = request.PublicatieDatum;
            film.RegisseurID = request.RegisseurId;

            filmContext.SaveChanges();
            return true;
        }

        public bool DeleteFilm(int id) 
        {
            var film = filmContext.Films.FirstOrDefault(film => film.Id == id);
            if (film == null) 
            {
                return false;
            } 

            filmContext.Films.Remove(film);
            filmContext.SaveChanges();

            return true;
        }
    }
}
