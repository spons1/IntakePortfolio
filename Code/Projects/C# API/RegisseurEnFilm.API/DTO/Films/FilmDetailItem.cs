namespace RegisseurEnFilm.API.DTO.Films
{
    public class FilmDetailItem
    {
        public int Id { get; set; }
        public string Titel { get; set; }
        public DateTime Publicatiedatum { get; set; }
        public int RegisseurId { get; set; }
        public string RegisseurNaam { get; set; }
    }
}
