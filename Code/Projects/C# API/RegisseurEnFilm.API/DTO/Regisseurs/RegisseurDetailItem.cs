namespace RegisseurEnFilm.API.DTO.Regisseurs
{
    public class RegisseurDetailItem
    {
        public int Id { get; set; }
        public string Naam { get; set; }
        public List<FilmLijst> lijstVanFilms { get; set; }

        public class FilmLijst
        {
            public int Id { get; set; }
            public string Titel { get; set; }
        }
    }
}
